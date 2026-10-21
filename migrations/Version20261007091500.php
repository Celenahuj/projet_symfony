<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261007091500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY `FK_AF3C67792063EF51`');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY `FK_AF3C6779B981C689`');
        $this->addSql('DROP INDEX IDX_AF3C6779B981C689 ON publication');
        $this->addSql('DROP INDEX IDX_AF3C67792063EF51 ON publication');
        $this->addSql('ALTER TABLE publication ADD utilisateur_id INT NOT NULL, ADD plante_utilisateur_id INT NOT NULL, DROP utilisateur_id_id, DROP plante_utilisateur_id_id');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677973F5B40F FOREIGN KEY (plante_utilisateur_id) REFERENCES plante_utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_AF3C6779FB88E14F ON publication (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_AF3C677973F5B40F ON publication (plante_utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779FB88E14F');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C677973F5B40F');
        $this->addSql('DROP INDEX IDX_AF3C6779FB88E14F ON publication');
        $this->addSql('DROP INDEX IDX_AF3C677973F5B40F ON publication');
        $this->addSql('ALTER TABLE publication ADD utilisateur_id_id INT NOT NULL, ADD plante_utilisateur_id_id INT NOT NULL, DROP utilisateur_id, DROP plante_utilisateur_id');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT `FK_AF3C67792063EF51` FOREIGN KEY (plante_utilisateur_id_id) REFERENCES plante_utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT `FK_AF3C6779B981C689` FOREIGN KEY (utilisateur_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AF3C6779B981C689 ON publication (utilisateur_id_id)');
        $this->addSql('CREATE INDEX IDX_AF3C67792063EF51 ON publication (plante_utilisateur_id_id)');
    }
}
