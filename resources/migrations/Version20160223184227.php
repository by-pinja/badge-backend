<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160223184227 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE `badge` ADD `createdAt` DATETIME NULL, ADD `updatedAt` DATETIME NULL;');
        $this->addSql('ALTER TABLE `badge_group` ADD `createdAt` DATETIME NULL, ADD `updatedAt` DATETIME NULL;');
        $this->addSql('ALTER TABLE `image` ADD `createdAt` DATETIME NULL, ADD `updatedAt` DATETIME NULL;');
        $this->addSql('ALTER TABLE `user` ADD `createdAt` DATETIME NULL, ADD `updatedAt` DATETIME NULL;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE `badge` DROP `createdAt`, DROP `updatedAt`;');
        $this->addSql('ALTER TABLE `badge_group` DROP `createdAt`, DROP `updatedAt`;');
        $this->addSql('ALTER TABLE `image` DROP `createdAt`, DROP `updatedAt`;');
        $this->addSql('ALTER TABLE `user` DROP `createdAt`, DROP `updatedAt`;');
    }
}
