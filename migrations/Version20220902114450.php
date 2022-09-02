<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220902114450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presentation_schedule (id INT AUTO_INCREMENT NOT NULL, main_subject_id INT DEFAULT NULL, reference_subject_id INT DEFAULT NULL, presentation_subject_id INT DEFAULT NULL, held DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, content_changed DATETIME DEFAULT NULL, label VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_48128BEB989D9B62 (slug), INDEX IDX_48128BEB3AC6A8E4 (main_subject_id), INDEX IDX_48128BEB5620E9C8 (reference_subject_id), INDEX IDX_48128BEB5826A6A6 (presentation_subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentation_schedule_presentation_type (presentation_schedule_id INT NOT NULL, presentation_type_id INT NOT NULL, INDEX IDX_99586FCCE838CAF1 (presentation_schedule_id), INDEX IDX_99586FCC583FCCCA (presentation_type_id), PRIMARY KEY(presentation_schedule_id, presentation_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentation_schedule_tag (presentation_schedule_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_A20F2550E838CAF1 (presentation_schedule_id), INDEX IDX_A20F2550BAD26311 (tag_id), PRIMARY KEY(presentation_schedule_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE presentation_schedule ADD CONSTRAINT FK_48128BEB3AC6A8E4 FOREIGN KEY (main_subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE presentation_schedule ADD CONSTRAINT FK_48128BEB5620E9C8 FOREIGN KEY (reference_subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE presentation_schedule ADD CONSTRAINT FK_48128BEB5826A6A6 FOREIGN KEY (presentation_subject_id) REFERENCES presentation_subject (id)');
        $this->addSql('ALTER TABLE presentation_schedule_presentation_type ADD CONSTRAINT FK_99586FCCE838CAF1 FOREIGN KEY (presentation_schedule_id) REFERENCES presentation_schedule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presentation_schedule_presentation_type ADD CONSTRAINT FK_99586FCC583FCCCA FOREIGN KEY (presentation_type_id) REFERENCES presentation_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presentation_schedule_tag ADD CONSTRAINT FK_A20F2550E838CAF1 FOREIGN KEY (presentation_schedule_id) REFERENCES presentation_schedule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presentation_schedule_tag ADD CONSTRAINT FK_A20F2550BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presentation_schedule DROP FOREIGN KEY FK_48128BEB3AC6A8E4');
        $this->addSql('ALTER TABLE presentation_schedule DROP FOREIGN KEY FK_48128BEB5620E9C8');
        $this->addSql('ALTER TABLE presentation_schedule DROP FOREIGN KEY FK_48128BEB5826A6A6');
        $this->addSql('ALTER TABLE presentation_schedule_presentation_type DROP FOREIGN KEY FK_99586FCCE838CAF1');
        $this->addSql('ALTER TABLE presentation_schedule_presentation_type DROP FOREIGN KEY FK_99586FCC583FCCCA');
        $this->addSql('ALTER TABLE presentation_schedule_tag DROP FOREIGN KEY FK_A20F2550E838CAF1');
        $this->addSql('ALTER TABLE presentation_schedule_tag DROP FOREIGN KEY FK_A20F2550BAD26311');
        $this->addSql('DROP TABLE presentation_schedule');
        $this->addSql('DROP TABLE presentation_schedule_presentation_type');
        $this->addSql('DROP TABLE presentation_schedule_tag');
    }
}
