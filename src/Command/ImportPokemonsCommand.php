<?php

namespace App\Command;

use App\Entity\Pokemon;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportPokemonsCommand extends Command
{
    protected static $defaultName = 'import-pokemons';
    protected static $defaultDescription = 'Import pokemons';

    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * @var string
     */
    private $projectDirectory;

    public function __construct(ManagerRegistry $managerRegistry, string $projectDirectory)
    {
        $this->projectDirectory = $projectDirectory;
        $this->managerRegistry = $managerRegistry;

        parent::__construct();
    }

    protected function configure(): void
    {
        /*$this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;*/
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note('Retrieving data ...');

        $filePath = sprintf('%s/config/data/pokemons.json', $this->projectDirectory);
        $fileContent = file_get_contents($filePath);
        $pokemons = json_decode($fileContent);
        $pokemons = array_slice($pokemons, 0, 151);
        $pokemonsCount = count($pokemons);

        $progressBar = new ProgressBar($output, $pokemonsCount);

        foreach ($pokemons as $pokemon) {
            $pokemonEntity = (new Pokemon())
                ->setId($pokemon->id)
                ->setName($pokemon->name->french)
            ;

            $this->managerRegistry->getManager()->persist($pokemonEntity);

            $progressBar->advance();
        }

        $progressBar->finish();

        $io->note('Flushing ...');
        $this->managerRegistry->getManager()->flush();

        $io->success('Done !');
        return Command::SUCCESS;
    }
}
