<?php

namespace Tania\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170930124648 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE resources (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, data_type VARCHAR(100) NOT NULL, unit VARCHAR(100) NOT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resourcesdevices (id INT AUTO_INCREMENT NOT NULL, device_id INT DEFAULT NULL, resource_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, rid VARCHAR(100) NOT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_E27EDE6B94A4C7D4 (device_id), INDEX IDX_E27EDE6B89329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE resourcesdevices ADD CONSTRAINT FK_E27EDE6B94A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id)');
        $this->addSql('ALTER TABLE resourcesdevices ADD CONSTRAINT FK_E27EDE6B89329D25 FOREIGN KEY (resource_id) REFERENCES resources (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE resourcesdevices DROP FOREIGN KEY FK_E27EDE6B89329D25');
        $this->addSql('DROP TABLE resources');
        $this->addSql('DROP TABLE resourcesdevices');
    }
}
