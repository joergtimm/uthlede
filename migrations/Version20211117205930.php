<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117205930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers_vereine DROP FOREIGN KEY FK_1043DA098AED6EB');
        $this->addSql('DROP INDEX IDX_1043DA098AED6EB ON pers_vereine');
        $this->addSql('ALTER TABLE pers_vereine DROP verein_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers_vereine ADD verein_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pers_vereine ADD CONSTRAINT FK_1043DA098AED6EB FOREIGN KEY (verein_id) REFERENCES vereine (id)');
        $this->addSql('CREATE INDEX IDX_1043DA098AED6EB ON pers_vereine (verein_id)');
    }
}
