<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117213716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers_vereine DROP FOREIGN KEY FK_1043DA09217BBB47');
        $this->addSql('DROP INDEX IDX_1043DA09217BBB47 ON pers_vereine');
        $this->addSql('ALTER TABLE pers_vereine DROP person_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers_vereine ADD person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pers_vereine ADD CONSTRAINT FK_1043DA09217BBB47 FOREIGN KEY (person_id) REFERENCES personen (id)');
        $this->addSql('CREATE INDEX IDX_1043DA09217BBB47 ON pers_vereine (person_id)');
    }
}
