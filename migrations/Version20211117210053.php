<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117210053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers_vereine ADD vereine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pers_vereine ADD CONSTRAINT FK_1043DA09A5D32040 FOREIGN KEY (vereine_id) REFERENCES vereine (id)');
        $this->addSql('CREATE INDEX IDX_1043DA09A5D32040 ON pers_vereine (vereine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers_vereine DROP FOREIGN KEY FK_1043DA09A5D32040');
        $this->addSql('DROP INDEX IDX_1043DA09A5D32040 ON pers_vereine');
        $this->addSql('ALTER TABLE pers_vereine DROP vereine_id');
    }
}
