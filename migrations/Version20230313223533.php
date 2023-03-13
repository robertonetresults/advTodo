<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313223533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE OR REPLACE FUNCTION update_position()
    RETURNS TRIGGER AS
$$
BEGIN
    IF OLD IS NULL OR OLD.position <> NEW.position THEN
        UPDATE post_it
        SET position = position + 1
        WHERE position >= NEW.position
          AND id <> NEW.id;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql');
        $this->addSql('CREATE OR REPLACE TRIGGER increment_position
    AFTER INSERT OR UPDATE
    ON post_it
    FOR EACH ROW
EXECUTE FUNCTION update_position()');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP TRIGGER IF EXISTS increment_position ON post_it');
        $this->addSql('DROP FUNCTION IF EXISTS update_position()');
    }
}
