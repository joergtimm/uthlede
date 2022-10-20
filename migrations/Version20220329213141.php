<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329213141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers_ver ADD verein_id INT DEFAULT NULL, ADD art VARCHAR(255) NOT NULL, ADD position INT DEFAULT NULL, ADD ansprechpartner TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE pers_ver ADD CONSTRAINT FK_8DF79F8A8AED6EB FOREIGN KEY (verein_id) REFERENCES vereine (id)');
        $this->addSql('CREATE INDEX IDX_8DF79F8A8AED6EB ON pers_ver (verein_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers_ver DROP FOREIGN KEY FK_8DF79F8A8AED6EB');
        $this->addSql('DROP INDEX IDX_8DF79F8A8AED6EB ON pers_ver');
        $this->addSql('ALTER TABLE pers_ver DROP verein_id, DROP art, DROP position, DROP ansprechpartner');
    }
}
