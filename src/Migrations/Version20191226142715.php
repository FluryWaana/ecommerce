<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191226142715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_paiement (type_paiement_id INT AUTO_INCREMENT NOT NULL, type_paiement_nom VARCHAR(255) NOT NULL, PRIMARY KEY(type_paiement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE commande ADD type_paiement_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D615593E9 FOREIGN KEY (type_paiement_id) REFERENCES type_paiement (type_paiement_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D615593E9 ON commande (type_paiement_id)');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D615593E9');
        $this->addSql('DROP TABLE type_paiement');
        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_6EEAA67D615593E9 ON commande');
        $this->addSql('ALTER TABLE commande DROP type_paiement_id');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
