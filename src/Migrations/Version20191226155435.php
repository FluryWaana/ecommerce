<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191226155435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4DE7DC5C');
        $this->addSql('DROP INDEX IDX_6EEAA67D4DE7DC5C ON commande');
        $this->addSql('ALTER TABLE commande ADD commande_adresse_livraison INT NOT NULL, CHANGE adresse_id commande_adresse_facture INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D365BBB4A FOREIGN KEY (commande_adresse_facture) REFERENCES adresse (adresse_id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF0342D59 FOREIGN KEY (commande_adresse_livraison) REFERENCES adresse (adresse_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D365BBB4A ON commande (commande_adresse_facture)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DF0342D59 ON commande (commande_adresse_livraison)');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D365BBB4A');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF0342D59');
        $this->addSql('DROP INDEX IDX_6EEAA67D365BBB4A ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DF0342D59 ON commande');
        $this->addSql('ALTER TABLE commande ADD adresse_id INT NOT NULL, DROP commande_adresse_facture, DROP commande_adresse_livraison');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (adresse_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D4DE7DC5C ON commande (adresse_id)');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
