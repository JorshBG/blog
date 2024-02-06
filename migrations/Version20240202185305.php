<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202185305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD COLUMN last_ip VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD COLUMN created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE category ADD COLUMN updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD COLUMN last_ip VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD COLUMN created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE comment ADD COLUMN updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD COLUMN last_ip VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD COLUMN created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE post ADD COLUMN updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN last_ip VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN updated DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__category AS SELECT id, name FROM category');
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(25) NOT NULL)');
        $this->addSql('INSERT INTO category (id, name) SELECT id, name FROM __temp__category');
        $this->addSql('DROP TABLE __temp__category');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, answer_id, post_id, title, content, love FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, answer_id INTEGER DEFAULT NULL, post_id INTEGER DEFAULT NULL, title VARCHAR(60) NOT NULL, content CLOB NOT NULL, love INTEGER NOT NULL, CONSTRAINT FK_9474526CAA334807 FOREIGN KEY (answer_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment (id, answer_id, post_id, title, content, love) SELECT id, answer_id, post_id, title, content, love FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526CAA334807 ON comment (answer_id)');
        $this->addSql('CREATE INDEX IDX_9474526C4B89032C ON comment (post_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, author_id, title, body FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(100) NOT NULL, body CLOB NOT NULL, CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post (id, author_id, title, body) SELECT id, author_id, title, body FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, first_name, last_name, photo, description, gender, phone FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, first_name VARCHAR(60) NOT NULL, last_name VARCHAR(60) NOT NULL, photo BLOB DEFAULT NULL, description CLOB DEFAULT NULL, gender VARCHAR(40) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, first_name, last_name, photo, description, gender, phone) SELECT id, email, roles, password, first_name, last_name, photo, description, gender, phone FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
