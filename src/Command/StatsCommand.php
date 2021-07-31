<?php

namespace App\Command;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StatsCommand extends Command
{
    protected static $defaultName = 'stats';
    protected static $defaultDescription = 'Display some stats';

    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
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

        $query = '
            SELECT
                pokemon.name,
                COUNT(*) AS count
            FROM spawned_pokemon
            INNER JOIN pokemon ON spawned_pokemon.pokemon_id = pokemon.id
            GROUP BY spawned_pokemon.pokemon_id
            ORDER BY COUNT(*) DESC
        ';

        $result = $this->managerRegistry->getConnection()->fetchAll($query);

        foreach ($result as $item) {
            $io->writeln(sprintf('%d : %s', $item['count'], $item['name']));
        }

        return Command::SUCCESS;
    }
}
