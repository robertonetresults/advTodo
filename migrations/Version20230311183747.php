<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311183747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE todo_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE todo_list (id INT NOT NULL, title VARCHAR(255) NOT NULL, last_modified TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN todo_list.last_modified IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE post_it ADD todo_list_id INT NOT NULL');
        $this->addSql('ALTER TABLE post_it ADD CONSTRAINT FK_563E1348E8A7DCFA FOREIGN KEY (todo_list_id) REFERENCES todo_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_563E1348E8A7DCFA ON post_it (todo_list_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE post_it DROP CONSTRAINT FK_563E1348E8A7DCFA');
        $this->addSql('DROP SEQUENCE todo_list_id_seq CASCADE');
        $this->addSql('DROP TABLE todo_list');
        $this->addSql('DROP INDEX IDX_563E1348E8A7DCFA');
        $this->addSql('ALTER TABLE post_it DROP todo_list_id');
    }
}
