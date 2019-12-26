<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191226145733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fournisseur (fournisseur_reference INT AUTO_INCREMENT NOT NULL, fournisseur_nom VARCHAR(60) NOT NULL, fournisseur_telephone VARCHAR(15) NOT NULL, fournisseur_email VARCHAR(180) NOT NULL, fournisseur_site VARCHAR(255) DEFAULT NULL, PRIMARY KEY(fournisseur_reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournir (fournisseur_reference INT NOT NULL, article_reference VARCHAR(25) NOT NULL, INDEX IDX_34D13A5253690576 (fournisseur_reference), INDEX IDX_34D13A5274961937 (article_reference), PRIMARY KEY(fournisseur_reference, article_reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fournir ADD CONSTRAINT FK_34D13A5253690576 FOREIGN KEY (fournisseur_reference) REFERENCES fournisseur (fournisseur_reference)');
        $this->addSql('ALTER TABLE fournir ADD CONSTRAINT FK_34D13A5274961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fournir DROP FOREIGN KEY FK_34D13A5253690576');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE fournir');
        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
