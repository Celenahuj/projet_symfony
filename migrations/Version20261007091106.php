<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261007091106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plante_utilisateur DROP FOREIGN KEY `FK_A88167EB1AFF595C`');
        $this->addSql('ALTER TABLE plante_utilisateur DROP FOREIGN KEY `FK_A88167EBB981C689`');
        $this->addSql('DROP INDEX IDX_A88167EB1AFF595C ON plante_utilisateur');
        $this->addSql('DROP INDEX IDX_A88167EBB981C689 ON plante_utilisateur');
        $this->addSql('ALTER TABLE plante_utilisateur ADD utilisateur_id INT NOT NULL, ADD plante_id INT NOT NULL, DROP utilisateur_id_id, DROP plante_id_id');
        $this->addSql('ALTER TABLE plante_utilisateur ADD CONSTRAINT FK_A88167EBFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE plante_utilisateur ADD CONSTRAINT FK_A88167EB177B16E8 FOREIGN KEY (plante_id) REFERENCES plante (id)');
        $this->addSql('CREATE INDEX IDX_A88167EBFB88E14F ON plante_utilisateur (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_A88167EB177B16E8 ON plante_utilisateur (plante_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plante_utilisateur DROP FOREIGN KEY FK_A88167EBFB88E14F');
        $this->addSql('ALTER TABLE plante_utilisateur DROP FOREIGN KEY FK_A88167EB177B16E8');
        $this->addSql('DROP INDEX IDX_A88167EBFB88E14F ON plante_utilisateur');
        $this->addSql('DROP INDEX IDX_A88167EB177B16E8 ON plante_utilisateur');
        $this->addSql('ALTER TABLE plante_utilisateur ADD utilisateur_id_id INT NOT NULL, ADD plante_id_id INT NOT NULL, DROP utilisateur_id, DROP plante_id');
        $this->addSql('ALTER TABLE plante_utilisateur ADD CONSTRAINT `FK_A88167EB1AFF595C` FOREIGN KEY (plante_id_id) REFERENCES plante (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE plante_utilisateur ADD CONSTRAINT `FK_A88167EBB981C689` FOREIGN KEY (utilisateur_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A88167EB1AFF595C ON plante_utilisateur (plante_id_id)');
        $this->addSql('CREATE INDEX IDX_A88167EBB981C689 ON plante_utilisateur (utilisateur_id_id)');
    }
}
