<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160225183416 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE `badge` ADD `createdBy_id` INT NULL AFTER `createdAt`, ADD INDEX (`createdBy_id`);');
        $this->addSql('ALTER TABLE `badge` ADD `updatedBy_id` INT NULL, ADD INDEX (`updatedBy_id`);');
        $this->addSql('ALTER TABLE `badge` ADD `deletedBy_id` INT NULL, ADD INDEX (`deletedBy_id`);');

        $this->addSql('ALTER TABLE `badge_group` ADD `createdBy_id` INT NULL AFTER `createdAt`, ADD INDEX (`createdBy_id`);');
        $this->addSql('ALTER TABLE `badge_group` ADD `updatedBy_id` INT NULL, ADD INDEX (`updatedBy_id`);');
        $this->addSql('ALTER TABLE `badge_group` ADD `deletedBy_id` INT NULL, ADD INDEX (`deletedBy_id`);');

        $this->addSql('ALTER TABLE `image` ADD `createdBy_id` INT NULL AFTER `createdAt`, ADD INDEX (`createdBy_id`);');
        $this->addSql('ALTER TABLE `image` ADD `updatedBy_id` INT NULL, ADD INDEX (`updatedBy_id`);');
        $this->addSql('ALTER TABLE `image` ADD `deletedBy_id` INT NULL, ADD INDEX (`deletedBy_id`);');

        $this->addSql('ALTER TABLE `user` ADD `createdBy_id` INT NULL AFTER `createdAt`, ADD INDEX (`createdBy_id`);');
        $this->addSql('ALTER TABLE `user` ADD `updatedBy_id` INT NULL, ADD INDEX (`updatedBy_id`);');
        $this->addSql('ALTER TABLE `user` ADD `deletedBy_id` INT NULL, ADD INDEX (`deletedBy_id`);');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE `badge` DROP `createdBy_id`, DROP `updatedBy_id`, DROP `deletedBy_id`;');
        $this->addSql('ALTER TABLE `badge_group` DROP `createdBy_id`, DROP `updatedBy_id`, DROP `deletedBy_id`;');
        $this->addSql('ALTER TABLE `image` DROP `createdBy_id`, DROP `updatedBy_id`, DROP `deletedBy_id`;');
        $this->addSql('ALTER TABLE `user` DROP `createdBy_id`, DROP `updatedBy_id`, DROP `deletedBy_id`;');
    }
}
