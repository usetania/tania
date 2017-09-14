<?php

namespace Tania\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170914142257 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE areas ADD field_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE areas ADD CONSTRAINT FK_58B0B25C443707B0 FOREIGN KEY (field_id) REFERENCES fields (id)');
        $this->addSql('CREATE INDEX IDX_58B0B25C443707B0 ON areas (field_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE areas DROP FOREIGN KEY FK_58B0B25C443707B0');
        $this->addSql('DROP INDEX IDX_58B0B25C443707B0 ON areas');
        $this->addSql('ALTER TABLE areas DROP field_id');
    }
}
