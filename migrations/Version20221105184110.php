<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221105184110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE spawned_pokemon_player (id INT AUTO_INCREMENT NOT NULL, spawned_pokemon_id INT NOT NULL, state VARCHAR(255) NOT NULL, INDEX IDX_41AE840472D0388D (spawned_pokemon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE spawned_pokemon_player ADD CONSTRAINT FK_41AE840472D0388D FOREIGN KEY (spawned_pokemon_id) REFERENCES spawned_pokemon (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE spawned_pokemon_player');
    }
}
