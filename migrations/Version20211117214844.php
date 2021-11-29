<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117214844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vereine DROP FOREIGN KEY FK_44A73349FD92C310');
        $this->addSql('DROP TABLE pers_vereine');
        $this->addSql('DROP INDEX IDX_44A73349FD92C310 ON vereine');
        $this->addSql('ALTER TABLE vereine DROP pers_vereine_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pers_vereine (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, rolle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, kontakt LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', rang INT DEFAULT NULL, INDEX IDX_1043DA09217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pers_vereine ADD CONSTRAINT FK_1043DA09217BBB47 FOREIGN KEY (person_id) REFERENCES personen (id)');
        $this->addSql('ALTER TABLE vereine ADD pers_vereine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vereine ADD CONSTRAINT FK_44A73349FD92C310 FOREIGN KEY (pers_vereine_id) REFERENCES pers_vereine (id)');
        $this->addSql('CREATE INDEX IDX_44A73349FD92C310 ON vereine (pers_vereine_id)');
    }
}
