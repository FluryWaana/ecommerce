<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191226155131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adresse (adresse_id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, fournisseur_reference INT DEFAULT NULL, adresse_rue VARCHAR(255) NOT NULL, adresse_complement VARCHAR(255) NOT NULL, adresse_ville VARCHAR(120) NOT NULL, adresse_code_postal VARCHAR(5) NOT NULL, INDEX IDX_C35F0816A76ED395 (user_id), INDEX IDX_C35F081653690576 (fournisseur_reference), PRIMARY KEY(adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081653690576 FOREIGN KEY (fournisseur_reference) REFERENCES fournisseur (fournisseur_reference)');
        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE commande ADD adresse_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (adresse_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D4DE7DC5C ON commande (adresse_id)');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4DE7DC5C');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_6EEAA67D4DE7DC5C ON commande');
        $this->addSql('ALTER TABLE commande DROP adresse_id');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
