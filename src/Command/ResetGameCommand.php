<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ResetGameCommand extends Command
{
    protected static $defaultName = 'app:reset-game';
    protected static $defaultDescription = 'Reset game data';

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $queries = [
            'DELETE FROM spawned_pokemon_player;',
            'DELETE FROM spawned_pokemon;',
            'DELETE FROM discovered_pokemon;',
        ];

        foreach($queries as $query) {
            $this->entityManager->getConnection()->executeQuery($query);
        }

        $io->success('Done.');

        return Command::SUCCESS;
    }
}
