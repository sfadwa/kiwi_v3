<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514140031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE data_energy (id INT AUTO_INCREMENT NOT NULL, machine_id INT NOT NULL, energy_id INT NOT NULL, value NUMERIC(10, 2) DEFAULT NULL, date DATE NOT NULL, INDEX IDX_F7EF4888F6B75B26 (machine_id), INDEX IDX_F7EF4888EDDF52D (energy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE energy_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, abbreviation VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE data_energy ADD CONSTRAINT FK_F7EF4888F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('ALTER TABLE data_energy ADD CONSTRAINT FK_F7EF4888EDDF52D FOREIGN KEY (energy_id) REFERENCES energy_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data_energy DROP FOREIGN KEY FK_F7EF4888F6B75B26');
        $this->addSql('ALTER TABLE data_energy DROP FOREIGN KEY FK_F7EF4888EDDF52D');
        $this->addSql('DROP TABLE data_energy');
        $this->addSql('DROP TABLE energy_type');
    }
}
