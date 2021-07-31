<?php

namespace App\Command;

use App\Entity\Pokemon;
use App\Entity\SpawnedPokemon;
use App\Repository\PokemonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SpawnerCommand extends Command
{
    protected static $defaultName = 'spawner';
    protected static $defaultDescription = 'Spawn some pokemons !';

    /**
     * @var PokemonRepository
     */
    private $pokemonRepository;

    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    public function __construct(PokemonRepository $pokemonRepository, ManagerRegistry $managerRegistry)
    {
        parent::__construct();
        $this->pokemonRepository = $pokemonRepository;
        $this->managerRegistry = $managerRegistry;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('count', InputArgument::REQUIRED, 'Count to spawn')
            // ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $count = (int) $input->getArgument('count');

        $io = new SymfonyStyle($input, $output);

        $io->note(sprintf('Generating %s pokemons...', $count));

        $availablePokemons = $this->pokemonRepository->findAll();

        $availablePokemons = array_filter($availablePokemons, function(Pokemon $pokemon) : bool {
            return 0 < $pokemon->getSpawnPercentage();
        });

        $io->note(sprintf('%d available, generation in progress ...', count($availablePokemons)));

        $pokemons = [];

        foreach ($availablePokemons as $availablePokemon) {
            array_push(
                $pokemons,
                ...array_fill(0, $availablePokemon->getSpawnPercentage(), $availablePokemon)
            );
        }

        for ($i = 0; $i < $count; $i++) {
            shuffle($pokemons);

            $index = array_rand($pokemons, 1);

            /** @var Pokemon $pokemon */
            $pokemon = $pokemons[$index];

            $endDate = (new \DateTimeImmutable())
                ->add(new \DateInterval(sprintf('PT%dS', $pokemon->getSpawnDuration())));

            $coordinates = $this->getRandomCoordinates();

            $spawnedPokemon = (new SpawnedPokemon())
                ->setPokemon($pokemon)
                ->setEndDate($endDate)
                ->setLatitude($coordinates['latitude'])
                ->setLongitude($coordinates['longitude'])
            ;

            $io->note(sprintf('Generating %s ...', $pokemon->getName()));

            $this->managerRegistry->getManager()->persist($spawnedPokemon);
        }

        $io->note('Flushing ...');

        $this->managerRegistry->getManager()->flush();

        $io->success('Done!');

        return Command::SUCCESS;
    }

    private function getRandomCoordinates()
    {
        $latitudeFrom = [50.66797909231886, 50.67490927217371];
        $longitudeTo = [3.0825136381315263, 3.093045892165666];

        return [
            'latitude' => $this->getRandomPoint($latitudeFrom[0], $latitudeFrom[1]),
            'longitude' => $this->getRandomPoint($longitudeTo[0], $longitudeTo[1]),
        ];
    }

    private function getRandomPoint($a, $b)
    {
        $maxDecimals = 0;

        foreach ([$a, $b] as $number) {
            $decimalCount = strlen(explode('.', (string) $number)[1]);

            if ($decimalCount > $maxDecimals) {
                $maxDecimals = $decimalCount;
            }
        }

        $multiplier = pow(10, $maxDecimals);

        $random = rand(
            (int) ($a * $multiplier),
            (int) ($b * $multiplier)
        ) / $multiplier;

        return $random;
    }
}
