<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429131113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, fonction_id INT DEFAULT NULL, libelle VARCHAR(20) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_1981A66D57889920 (fonction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D57889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D57889920');
        $this->addSql('DROP TABLE operation');
    }
}
