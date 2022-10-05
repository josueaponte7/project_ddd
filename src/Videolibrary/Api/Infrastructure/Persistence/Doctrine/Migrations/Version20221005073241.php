<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005073241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subtitle (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', video_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', language VARCHAR(2) NOT NULL, INDEX IDX_518597B129C1004E (video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, duration INT NOT NULL, status VARCHAR(20) NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subtitle ADD CONSTRAINT FK_518597B129C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subtitle DROP FOREIGN KEY FK_518597B129C1004E');
        $this->addSql('DROP TABLE subtitle');
        $this->addSql('DROP TABLE video');
    }
}
