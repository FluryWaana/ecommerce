<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200102231453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_categorie ADD article_categorie_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_93488610295F26B9 FOREIGN KEY (article_categorie_parent_id) REFERENCES article_categorie (article_categorie_id)');
        $this->addSql('CREATE INDEX IDX_93488610295F26B9 ON article_categorie (article_categorie_parent_id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D615593E9 FOREIGN KEY (type_paiement_id) REFERENCES type_paiement (type_paiement_id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D365BBB4A FOREIGN KEY (commande_adresse_facture) REFERENCES adresse (adresse_id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF0342D59 FOREIGN KEY (commande_adresse_livraison) REFERENCES adresse (adresse_id)');
        $this->addSql('ALTER TABLE commande_avoir_article ADD CONSTRAINT FK_D5899390BEAF1351 FOREIGN KEY (commande_reference) REFERENCES commande (commande_reference)');
        $this->addSql('ALTER TABLE commande_avoir_article ADD CONSTRAINT FK_D589939074961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
        $this->addSql('ALTER TABLE fournir ADD CONSTRAINT FK_34D13A5253690576 FOREIGN KEY (fournisseur_reference) REFERENCES fournisseur (fournisseur_reference)');
        $this->addSql('ALTER TABLE fournir ADD CONSTRAINT FK_34D13A5274961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F74961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_93488610295F26B9');
        $this->addSql('DROP INDEX IDX_93488610295F26B9 ON article_categorie');
        $this->addSql('ALTER TABLE article_categorie DROP article_categorie_parent_id');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D615593E9');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D365BBB4A');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF0342D59');
        $this->addSql('ALTER TABLE commande_avoir_article DROP FOREIGN KEY FK_D5899390BEAF1351');
        $this->addSql('ALTER TABLE commande_avoir_article DROP FOREIGN KEY FK_D589939074961937');
        $this->addSql('ALTER TABLE fournir DROP FOREIGN KEY FK_34D13A5253690576');
        $this->addSql('ALTER TABLE fournir DROP FOREIGN KEY FK_34D13A5274961937');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F74961937');
    }
}
