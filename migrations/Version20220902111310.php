<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220902111310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presentation_subject (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, content_changed DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_66BD7E23989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, content_changed DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_389B783989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_presentation_subject (tag_id INT NOT NULL, presentation_subject_id INT NOT NULL, INDEX IDX_4C8A6A28BAD26311 (tag_id), INDEX IDX_4C8A6A285826A6A6 (presentation_subject_id), PRIMARY KEY(tag_id, presentation_subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_presentation_subject ADD CONSTRAINT FK_4C8A6A28BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_presentation_subject ADD CONSTRAINT FK_4C8A6A285826A6A6 FOREIGN KEY (presentation_subject_id) REFERENCES presentation_subject (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag_presentation_subject DROP FOREIGN KEY FK_4C8A6A28BAD26311');
        $this->addSql('ALTER TABLE tag_presentation_subject DROP FOREIGN KEY FK_4C8A6A285826A6A6');
        $this->addSql('DROP TABLE presentation_subject');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_presentation_subject');
    }
}
