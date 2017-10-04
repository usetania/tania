<?php

namespace Tania\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170918155155 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE areasdevices (id INT AUTO_INCREMENT NOT NULL, area_id INT DEFAULT NULL, device_id INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_BC0E507EBD0F409C (area_id), INDEX IDX_BC0E507E94A4C7D4 (device_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devices (id INT AUTO_INCREMENT NOT NULL, field_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, device_type INT NOT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_11074E9A443707B0 (field_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE areasdevices ADD CONSTRAINT FK_BC0E507EBD0F409C FOREIGN KEY (area_id) REFERENCES areas (id)');
        $this->addSql('ALTER TABLE areasdevices ADD CONSTRAINT FK_BC0E507E94A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id)');
        $this->addSql('ALTER TABLE devices ADD CONSTRAINT FK_11074E9A443707B0 FOREIGN KEY (field_id) REFERENCES fields (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE areasdevices DROP FOREIGN KEY FK_BC0E507E94A4C7D4');
        $this->addSql('DROP TABLE areasdevices');
        $this->addSql('DROP TABLE devices');
    }
}
