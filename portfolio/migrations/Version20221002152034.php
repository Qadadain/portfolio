<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221002152034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_old_slug (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, old_slug VARCHAR(255) DEFAULT NULL, INDEX IDX_FED93664B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_old_slug ADD CONSTRAINT FK_FED93664B89032C FOREIGN KEY (post_id) REFERENCES blog_post (id)');
        $this->addSql('ALTER TABLE blog_post CHANGE slug slug VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE post_old_slug');
        $this->addSql('ALTER TABLE blog_post CHANGE slug slug VARCHAR(255) NOT NULL');
    }
}
