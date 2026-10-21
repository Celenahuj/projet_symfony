<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261007091636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY `FK_67F068BC9A9AD8DB`');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY `FK_67F068BCB981C689`');
        $this->addSql('DROP INDEX IDX_67F068BC9A9AD8DB ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BCB981C689 ON commentaire');
        $this->addSql('ALTER TABLE commentaire ADD publication_id INT NOT NULL, ADD utilisateur_id INT NOT NULL, DROP publication_id_id, DROP utilisateur_id_id');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC38B217A7 ON commentaire (publication_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCFB88E14F ON commentaire (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC38B217A7');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFB88E14F');
        $this->addSql('DROP INDEX IDX_67F068BC38B217A7 ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BCFB88E14F ON commentaire');
        $this->addSql('ALTER TABLE commentaire ADD publication_id_id INT NOT NULL, ADD utilisateur_id_id INT NOT NULL, DROP publication_id, DROP utilisateur_id');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT `FK_67F068BC9A9AD8DB` FOREIGN KEY (publication_id_id) REFERENCES publication (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT `FK_67F068BCB981C689` FOREIGN KEY (utilisateur_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_67F068BC9A9AD8DB ON commentaire (publication_id_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCB981C689 ON commentaire (utilisateur_id_id)');
    }
}
