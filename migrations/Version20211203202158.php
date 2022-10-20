<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203202158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artikel_mitwirkungen ADD person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artikel_mitwirkungen ADD CONSTRAINT FK_3619ECA7217BBB47 FOREIGN KEY (person_id) REFERENCES personen (id)');
        $this->addSql('CREATE INDEX IDX_3619ECA7217BBB47 ON artikel_mitwirkungen (person_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artikel_mitwirkungen DROP FOREIGN KEY FK_3619ECA7217BBB47');
        $this->addSql('DROP INDEX IDX_3619ECA7217BBB47 ON artikel_mitwirkungen');
        $this->addSql('ALTER TABLE artikel_mitwirkungen DROP person_id');
    }
}
