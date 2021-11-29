<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117204117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ch_cookieconsent_log (id INT AUTO_INCREMENT NOT NULL, ip_address VARCHAR(255) NOT NULL, cookie_consent_key VARCHAR(255) NOT NULL, cookie_name VARCHAR(255) NOT NULL, cookie_value VARCHAR(255) NOT NULL, timestamp DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pers_vereine (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, verein_id INT DEFAULT NULL, rolle VARCHAR(255) DEFAULT NULL, kontakt LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', rang INT DEFAULT NULL, INDEX IDX_1043DA09217BBB47 (person_id), INDEX IDX_1043DA098AED6EB (verein_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tankstellen (id INT AUTO_INCREMENT NOT NULL, tid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, brand VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, lat DOUBLE PRECISION DEFAULT NULL, lng DOUBLE PRECISION DEFAULT NULL, diesel DOUBLE PRECISION DEFAULT NULL, e5 DOUBLE PRECISION DEFAULT NULL, e10 DOUBLE PRECISION DEFAULT NULL, is_open TINYINT(1) DEFAULT NULL, house_number VARCHAR(255) DEFAULT NULL, post_code VARCHAR(255) DEFAULT NULL, update_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', opening_times LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', overrides LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', whole_day TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pers_vereine ADD CONSTRAINT FK_1043DA09217BBB47 FOREIGN KEY (person_id) REFERENCES personen (id)');
        $this->addSql('ALTER TABLE pers_vereine ADD CONSTRAINT FK_1043DA098AED6EB FOREIGN KEY (verein_id) REFERENCES vereine (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ch_cookieconsent_log');
        $this->addSql('DROP TABLE pers_vereine');
        $this->addSql('DROP TABLE tankstellen');
    }
}
