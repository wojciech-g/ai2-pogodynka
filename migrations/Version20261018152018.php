<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261018152018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE localization (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country_code VARCHAR(2) NOT NULL, latitude NUMERIC(10, 7) NOT NULL, longitude NUMERIC(10, 7) NOT NULL)');
        $this->addSql('CREATE TABLE measurement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, measured_at DATETIME NOT NULL, temp_celsius NUMERIC(4, 1) NOT NULL, precipitation_mm NUMERIC(5, 1) NOT NULL, wind_speed_kmh NUMERIC(5, 1) NOT NULL, pressure_hpa NUMERIC(6, 1) NOT NULL, humidity_percent SMALLINT NOT NULL, localization_id INTEGER NOT NULL, CONSTRAINT FK_2CE0D8116A2856C7 FOREIGN KEY (localization_id) REFERENCES localization (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2CE0D8116A2856C7 ON measurement (localization_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE localization');
        $this->addSql('DROP TABLE measurement');
    }
}
