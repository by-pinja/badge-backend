<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160215203422 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE UNIQUE INDEX uq_username ON `user` (username);');
        $this->addSql('CREATE UNIQUE INDEX uq_email ON `user` (email);');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE user DROP INDEX uq_username;');
        $this->addSql('ALTER TABLE user DROP INDEX uq_email;');
    }
}
