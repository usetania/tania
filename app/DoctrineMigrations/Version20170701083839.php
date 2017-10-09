<?php

namespace Tania\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170701083839 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `seed_categories` (`id`, `name`, `slug`, `description`, `updated_at`, `created_at`) VALUES
            (1, 'Herb', 'herb', NULL, NULL, NOW()),
            (2, 'Vegetable', 'vegetable', NULL, NULL, NOW()),
            (3, 'Sprout/Microgreens', 'sprout-microgreens', NULL, NULL, NOW()),
            (4, 'Fruit', 'fruit', NULL, NULL, NOW()),
            (5, 'Tubber', 'tubber', NULL, NULL, NOW()),
            (6, 'Flower', 'flower', NULL, NULL, NOW()),
            (7, 'Other', 'other', NULL, NULL, NOW());");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('TRUNCATE TABLE `seed_categories`;');
    }
}
