<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261007081257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plante_utilisateur (id INT AUTO_INCREMENT NOT NULL, surnom VARCHAR(255) NOT NULL, photo_personnelle VARCHAR(255) NOT NULL, date_ajout DATETIME NOT NULL, desactive_le DATETIME DEFAULT NULL, utilisateur_id_id INT NOT NULL, plante_id_id INT NOT NULL, INDEX IDX_A88167EBB981C689 (utilisateur_id_id), INDEX IDX_A88167EB1AFF595C (plante_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('ALTER TABLE plante_utilisateur ADD CONSTRAINT FK_A88167EBB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE plante_utilisateur ADD CONSTRAINT FK_A88167EB1AFF595C FOREIGN KEY (plante_id_id) REFERENCES plante (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plante_utilisateur DROP FOREIGN KEY FK_A88167EBB981C689');
        $this->addSql('ALTER TABLE plante_utilisateur DROP FOREIGN KEY FK_A88167EB1AFF595C');
        $this->addSql('DROP TABLE plante_utilisateur');
    }
}
