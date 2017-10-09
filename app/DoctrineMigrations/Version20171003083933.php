<?php

namespace Tania\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171003083933 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE resources DROP data_type, DROP unit');

        // seeding resources data
        $this->addSql('INSERT INTO resources (`type`, `created_at`) VALUES ("Temperature", NOW())');
        $this->addSql('INSERT INTO resources (`type`, `created_at`) VALUES ("Humidity", NOW())');
        $this->addSql('INSERT INTO resources (`type`, `created_at`) VALUES ("Light", NOW())');
        $this->addSql('INSERT INTO resources (`type`, `created_at`) VALUES ("Nutrition", NOW())');
        $this->addSql('INSERT INTO resources (`type`, `created_at`) VALUES ("Moisture", NOW())');
        $this->addSql('INSERT INTO resources (`type`, `created_at`) VALUES ("pH", NOW())');
        $this->addSql('INSERT INTO resources (`type`, `created_at`) VALUES ("On/Off State", NOW())');
        $this->addSql('INSERT INTO resources (`type`, `created_at`) VALUES ("Custom", NOW())');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE resources ADD data_type VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, ADD unit VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        
        // emptying the table
        $this->addSql('TRUNCATE TABLE resources');
    }
}
