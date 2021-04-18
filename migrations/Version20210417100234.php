<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210417100234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE person (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, fk_team_id_id INTEGER DEFAULT NULL, vorname VARCHAR(255) NOT NULL, nachname VARCHAR(255) NOT NULL, kd DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD176482C1D84 ON person (fk_team_id_id)');
        $this->addSql('CREATE TABLE team (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE turnier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, fk_team1_id_id INTEGER NOT NULL, fk_team2_id_id INTEGER NOT NULL, fk_winner_id_id INTEGER DEFAULT NULL, game VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, starting_time DATE DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67C8FBF63118AE9E ON turnier (fk_team1_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67C8FBF6F0B403 ON turnier (fk_team2_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67C8FBF6DD8ED6F0 ON turnier (fk_winner_id_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, passwort VARCHAR(1000) NOT NULL, rechte INTEGER DEFAULT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE turnier');
        $this->addSql('DROP TABLE user');
    }
}
