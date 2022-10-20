<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203202435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artikel_mitwirkungen DROP FOREIGN KEY FK_3619ECA7A76ED395');
        $this->addSql('DROP INDEX IDX_3619ECA7A76ED395 ON artikel_mitwirkungen');
        $this->addSql('ALTER TABLE artikel_mitwirkungen DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artikel_mitwirkungen ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artikel_mitwirkungen ADD CONSTRAINT FK_3619ECA7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3619ECA7A76ED395 ON artikel_mitwirkungen (user_id)');
    }
}
