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
            (1, 'Herb', 'herb', NULL, NULL, '2017-06-17 00:00:00'),
            (2, 'Vegetable', 'vegetable', NULL, NULL, '2017-06-17 00:00:00'),
            (3, 'Sprout/Microgreens', 'sprout-microgreens', NULL, NULL, '2017-06-17 00:00:00'),
            (4, 'Fruit', 'fruit', NULL, NULL, '2017-06-17 00:00:00'),
            (5, 'Tubber', 'tubber', NULL, NULL, '2017-06-17 00:00:00'),
            (6, 'Flower', 'flower', NULL, NULL, '2017-06-17 00:00:00'),
            (7, 'Other', 'other', NULL, NULL, '2017-06-17 00:00:00');");
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
