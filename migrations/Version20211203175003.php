<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203175003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artikel_mitwirkungen ADD artikel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artikel_mitwirkungen ADD CONSTRAINT FK_3619ECA7EEDF290A FOREIGN KEY (artikel_id) REFERENCES articel (id)');
        $this->addSql('CREATE INDEX IDX_3619ECA7EEDF290A ON artikel_mitwirkungen (artikel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artikel_mitwirkungen DROP FOREIGN KEY FK_3619ECA7EEDF290A');
        $this->addSql('DROP INDEX IDX_3619ECA7EEDF290A ON artikel_mitwirkungen');
        $this->addSql('ALTER TABLE artikel_mitwirkungen DROP artikel_id');
    }
}
