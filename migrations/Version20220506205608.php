<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506205608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu_panier DROP FOREIGN KEY FK_80507DC0F77D927C');
        $this->addSql('ALTER TABLE contenu_panier DROP FOREIGN KEY FK_80507DC0F347EFB');
        $this->addSql('DROP INDEX IDX_80507DC0F347EFB ON contenu_panier');
        $this->addSql('DROP INDEX IDX_80507DC0F77D927C ON contenu_panier');
        $this->addSql('ALTER TABLE contenu_panier DROP produit_id, DROP panier_id');
        $this->addSql('ALTER TABLE panier ADD montant DOUBLE PRECISION NOT NULL, ADD quantite INT NOT NULL, CHANGE etat etat TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu_panier ADD produit_id INT NOT NULL, ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contenu_panier ADD CONSTRAINT FK_80507DC0F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE contenu_panier ADD CONSTRAINT FK_80507DC0F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_80507DC0F347EFB ON contenu_panier (produit_id)');
        $this->addSql('CREATE INDEX IDX_80507DC0F77D927C ON contenu_panier (panier_id)');
        $this->addSql('ALTER TABLE panier DROP montant, DROP quantite, CHANGE etat etat VARCHAR(255) NOT NULL');
    }
}
