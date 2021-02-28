<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026104117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articel ADD thema_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articel ADD CONSTRAINT FK_AA240D8BD660E3D0 FOREIGN KEY (thema_id) REFERENCES themen (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA240D8B989D9B62 ON articel (slug)');
        $this->addSql('CREATE INDEX IDX_AA240D8BD660E3D0 ON articel (thema_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articel DROP FOREIGN KEY FK_AA240D8BD660E3D0');
        $this->addSql('DROP INDEX UNIQ_AA240D8B989D9B62 ON articel');
        $this->addSql('DROP INDEX IDX_AA240D8BD660E3D0 ON articel');
        $this->addSql('ALTER TABLE articel DROP thema_id');
    }
}
