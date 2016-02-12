<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160212210450 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql($this->getCreateSql());
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('badge');
        $schema->dropTable('image');
        $schema->dropTable('badge_group');
        $schema->dropTable('user');
    }

    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema)
    {
        // Data to add
        $data = [
            'username'      => 'admin',
            'firstname'     => 'Arnold',
            'surname'       => 'Administrator',
            'email'         => 'arnold@foobar.com',
            'password'      =>  password_hash('nimda', \PASSWORD_DEFAULT, ['cost' => 12]),
            'roles'         => 'ROLE_ADMIN',
        ];

        $this->connection->insert('user', $data);
    }

    private function getCreateSql()
    {
        return "
          CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
          CREATE TABLE badge_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
          CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, mime VARCHAR(255) NOT NULL, data BLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
          CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, badge_group_id INT DEFAULT NULL, image_id INT DEFAULT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, INDEX fk_badge_badge_group_id (badge_group_id), INDEX fk_badge_image_id (image_id), INDEX fk_badge_user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
          ALTER TABLE badge ADD CONSTRAINT FK_FEF0481D3C85A2E9 FOREIGN KEY (badge_group_id) REFERENCES badge_group (id);
          ALTER TABLE badge ADD CONSTRAINT FK_FEF0481D3DA5256D FOREIGN KEY (image_id) REFERENCES image (id);
          ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id);
        ";
    }
}
