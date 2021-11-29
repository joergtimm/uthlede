<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117232441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pers_ver (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, art VARCHAR(255) NOT NULL, rolle VARCHAR(255) DEFAULT NULL, kontakt LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', INDEX IDX_8DF79F8A217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pers_ver ADD CONSTRAINT FK_8DF79F8A217BBB47 FOREIGN KEY (person_id) REFERENCES personen (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pers_ver');
    }
}
