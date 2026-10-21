<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261007085941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, contenu LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, desactive_le DATETIME DEFAULT NULL, publication_id_id INT NOT NULL, utilisateur_id_id INT NOT NULL, INDEX IDX_67F068BC9A9AD8DB (publication_id_id), INDEX IDX_67F068BCB981C689 (utilisateur_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, url_image VARCHAR(255) NOT NULL, legende LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, desactive_le DATETIME DEFAULT NULL, utilisateur_id_id INT NOT NULL, plante_utilisateur_id_id INT NOT NULL, INDEX IDX_AF3C6779B981C689 (utilisateur_id_id), INDEX IDX_AF3C67792063EF51 (plante_utilisateur_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC9A9AD8DB FOREIGN KEY (publication_id_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779B981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67792063EF51 FOREIGN KEY (plante_utilisateur_id_id) REFERENCES plante_utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC9A9AD8DB');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB981C689');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779B981C689');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67792063EF51');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE publication');
    }
}
