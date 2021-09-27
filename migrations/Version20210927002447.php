<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210927002447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historisch (id INT AUTO_INCREMENT NOT NULL, titel VARCHAR(255) NOT NULL, thema VARCHAR(255) DEFAULT NULL, titelbild VARCHAR(255) DEFAULT NULL, beschreibung LONGTEXT DEFAULT NULL, referenzen VARCHAR(255) DEFAULT NULL, quellen VARCHAR(255) DEFAULT NULL, position INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personen (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, vorname VARCHAR(255) DEFAULT NULL, adresse LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', kontakt LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', beschreibung LONGTEXT DEFAULT NULL, geboren DATE DEFAULT NULL, wohnhaft_ab DATE DEFAULT NULL, wohnhaft_bis DATE DEFAULT NULL, rollen LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', foto VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vereine (id INT AUTO_INCREMENT NOT NULL, ansprechpartner_id INT DEFAULT NULL, titel VARCHAR(255) NOT NULL, aktiv TINYINT(1) DEFAULT NULL, beschreibung LONGTEXT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, INDEX IDX_44A7334970AE848B (ansprechpartner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vereine ADD CONSTRAINT FK_44A7334970AE848B FOREIGN KEY (ansprechpartner_id) REFERENCES personen (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vereine DROP FOREIGN KEY FK_44A7334970AE848B');
        $this->addSql('DROP TABLE historisch');
        $this->addSql('DROP TABLE personen');
        $this->addSql('DROP TABLE vereine');
    }
}
