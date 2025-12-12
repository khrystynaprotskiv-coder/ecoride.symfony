<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251208145451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2D0B6BCE7E3C61F9 ON travel (owner_id)');
        $this->addSql('ALTER TABLE user ADD credits INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP credits');
        $this->addSql('ALTER TABLE travel DROP FOREIGN KEY FK_2D0B6BCE7E3C61F9');
        $this->addSql('DROP INDEX IDX_2D0B6BCE7E3C61F9 ON travel');
    }
}
