<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506131655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu_panier ADD produit_id INT NOT NULL, ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contenu_panier ADD CONSTRAINT FK_80507DC0F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE contenu_panier ADD CONSTRAINT FK_80507DC0F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_80507DC0F347EFB ON contenu_panier (produit_id)');
        $this->addSql('CREATE INDEX IDX_80507DC0F77D927C ON contenu_panier (panier_id)');
        $this->addSql('ALTER TABLE panier ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_24CC0DF2A76ED395 ON panier (user_id)');
        $this->addSql('ALTER TABLE produit CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu_panier DROP FOREIGN KEY FK_80507DC0F347EFB');
        $this->addSql('ALTER TABLE contenu_panier DROP FOREIGN KEY FK_80507DC0F77D927C');
        $this->addSql('DROP INDEX IDX_80507DC0F347EFB ON contenu_panier');
        $this->addSql('DROP INDEX IDX_80507DC0F77D927C ON contenu_panier');
        $this->addSql('ALTER TABLE contenu_panier DROP produit_id, DROP panier_id');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('DROP INDEX IDX_24CC0DF2A76ED395 ON panier');
        $this->addSql('ALTER TABLE panier DROP user_id');
        $this->addSql('ALTER TABLE produit CHANGE photo photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
