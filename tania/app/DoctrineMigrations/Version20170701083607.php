<?php

namespace Tania\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170701083607 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE areas (id INT AUTO_INCREMENT NOT NULL, reservoir_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, growing_method INT NOT NULL, capacity INT NOT NULL, measurement_unit INT NOT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_original_name VARCHAR(255) DEFAULT NULL, image_mime_type VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, INDEX IDX_58B0B25CCDD6B674 (reservoir_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fields (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, lat NUMERIC(10, 8) DEFAULT NULL, lng NUMERIC(11, 8) DEFAULT NULL, description LONGTEXT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_original_name VARCHAR(255) DEFAULT NULL, image_mime_type VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plants (id INT AUTO_INCREMENT NOT NULL, area_id INT NOT NULL, seed_id INT NOT NULL, seedling_date DATE DEFAULT NULL, seedling_amount INT NOT NULL, area_capacity INT NOT NULL, harvesting_date DATE DEFAULT NULL, disposing_date DATE DEFAULT NULL, note LONGTEXT DEFAULT NULL, action VARCHAR(10) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_A5AEDC16BD0F409C (area_id), INDEX IDX_A5AEDC1664430F6A (seed_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservoirs (id INT AUTO_INCREMENT NOT NULL, field_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, capacity NUMERIC(10, 2) NOT NULL, measurement_unit INT NOT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_3CAD99A4443707B0 (field_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seeds (id INT AUTO_INCREMENT NOT NULL, seedcategory_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, quantity INT NOT NULL, measurement_unit INT NOT NULL, producer_name VARCHAR(150) NOT NULL, origin_country VARCHAR(100) NOT NULL, note LONGTEXT DEFAULT NULL, expiration_month VARCHAR(20) NOT NULL, expiration_year INT NOT NULL, germination_rate NUMERIC(5, 2) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_original_name VARCHAR(255) DEFAULT NULL, image_mime_type VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, INDEX IDX_F229EDDD89C54042 (seedcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seed_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tasks (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, notes LONGTEXT DEFAULT NULL, category VARCHAR(50) NOT NULL, due_date DATETIME NOT NULL, urgency_level VARCHAR(15) NOT NULL, is_done INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_1483A5E9C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE areas ADD CONSTRAINT FK_58B0B25CCDD6B674 FOREIGN KEY (reservoir_id) REFERENCES reservoirs (id)');
        $this->addSql('ALTER TABLE plants ADD CONSTRAINT FK_A5AEDC16BD0F409C FOREIGN KEY (area_id) REFERENCES areas (id)');
        $this->addSql('ALTER TABLE plants ADD CONSTRAINT FK_A5AEDC1664430F6A FOREIGN KEY (seed_id) REFERENCES seeds (id)');
        $this->addSql('ALTER TABLE reservoirs ADD CONSTRAINT FK_3CAD99A4443707B0 FOREIGN KEY (field_id) REFERENCES fields (id)');
        $this->addSql('ALTER TABLE seeds ADD CONSTRAINT FK_F229EDDD89C54042 FOREIGN KEY (seedcategory_id) REFERENCES seed_categories (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plants DROP FOREIGN KEY FK_A5AEDC16BD0F409C');
        $this->addSql('ALTER TABLE reservoirs DROP FOREIGN KEY FK_3CAD99A4443707B0');
        $this->addSql('ALTER TABLE areas DROP FOREIGN KEY FK_58B0B25CCDD6B674');
        $this->addSql('ALTER TABLE plants DROP FOREIGN KEY FK_A5AEDC1664430F6A');
        $this->addSql('ALTER TABLE seeds DROP FOREIGN KEY FK_F229EDDD89C54042');
        $this->addSql('DROP TABLE areas');
        $this->addSql('DROP TABLE fields');
        $this->addSql('DROP TABLE plants');
        $this->addSql('DROP TABLE reservoirs');
        $this->addSql('DROP TABLE seeds');
        $this->addSql('DROP TABLE seed_categories');
        $this->addSql('DROP TABLE tasks');
        $this->addSql('DROP TABLE users');
    }
}
