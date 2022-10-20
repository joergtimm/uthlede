<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329214420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE htmlblocks (id INT AUTO_INCREMENT NOT NULL, art VARCHAR(255) NOT NULL, position INT DEFAULT NULL, url1 VARCHAR(255) DEFAULT NULL, url1art VARCHAR(255) DEFAULT NULL, url2 VARCHAR(255) DEFAULT NULL, url2art VARCHAR(255) DEFAULT NULL, url3 VARCHAR(255) DEFAULT NULL, url3art VARCHAR(255) DEFAULT NULL, text1 VARCHAR(255) DEFAULT NULL, text2 LONGTEXT DEFAULT NULL, mt INT DEFAULT NULL, mb INT DEFAULT NULL, create_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE htmlblocks');
    }
}
