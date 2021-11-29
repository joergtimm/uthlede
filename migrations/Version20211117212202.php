<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117212202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vereine ADD pers_vereine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vereine ADD CONSTRAINT FK_44A73349FD92C310 FOREIGN KEY (pers_vereine_id) REFERENCES pers_vereine (id)');
        $this->addSql('CREATE INDEX IDX_44A73349FD92C310 ON vereine (pers_vereine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vereine DROP FOREIGN KEY FK_44A73349FD92C310');
        $this->addSql('DROP INDEX IDX_44A73349FD92C310 ON vereine');
        $this->addSql('ALTER TABLE vereine DROP pers_vereine_id');
    }
}
