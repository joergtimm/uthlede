<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211002001451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, articel_id INT DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', text LONGTEXT NOT NULL, is_visible TINYINT(1) DEFAULT NULL, is_deleted TINYINT(1) DEFAULT NULL, INDEX IDX_5F9E962AF675F31B (author_id), INDEX IDX_5F9E962A28CAB67 (articel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A28CAB67 FOREIGN KEY (articel_id) REFERENCES articel (id)');
        $this->addSql('ALTER TABLE articel ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articel ADD CONSTRAINT FK_AA240D8BF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AA240D8BF675F31B ON articel (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comments');
        $this->addSql('ALTER TABLE articel DROP FOREIGN KEY FK_AA240D8BF675F31B');
        $this->addSql('DROP INDEX IDX_AA240D8BF675F31B ON articel');
        $this->addSql('ALTER TABLE articel DROP author_id');
    }
}
