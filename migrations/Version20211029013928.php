<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029013928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personen ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personen ADD CONSTRAINT FK_7BE8C9ACA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7BE8C9ACA76ED395 ON personen (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personen DROP FOREIGN KEY FK_7BE8C9ACA76ED395');
        $this->addSql('DROP INDEX UNIQ_7BE8C9ACA76ED395 ON personen');
        $this->addSql('ALTER TABLE personen DROP user_id');
    }
}
