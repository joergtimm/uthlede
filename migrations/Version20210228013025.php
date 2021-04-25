<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228013025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artikel_bilder (id INT AUTO_INCREMENT NOT NULL, artikel_id INT NOT NULL, filename VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, text VARCHAR(255) DEFAULT NULL, INDEX IDX_328FC47FEEDF290A (artikel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artikel_bilder ADD CONSTRAINT FK_328FC47FEEDF290A FOREIGN KEY (artikel_id) REFERENCES articel (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE artikel_bilder');
    }
}
