<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200105202357 extends AbstractMigration
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
        $this->addSql('CREATE TABLE article (article_reference VARCHAR(25) NOT NULL, article_categorie_id INT NOT NULL, article_designation VARCHAR(80) NOT NULL, article_prix_ht DOUBLE PRECISION NOT NULL, article_description_courte VARCHAR(255) NOT NULL, article_description_longue LONGTEXT NOT NULL, article_minimum_stock INT NOT NULL, article_stock INT NOT NULL, INDEX IDX_23A0E666FB990BC (article_categorie_id), PRIMARY KEY(article_reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_avoir_meta (article_reference VARCHAR(25) NOT NULL, article_meta_id INT NOT NULL, INDEX IDX_7F35E83E74961937 (article_reference), INDEX IDX_7F35E83ED42EE24E (article_meta_id), PRIMARY KEY(article_reference, article_meta_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_avoir_promotion (article_reference VARCHAR(25) NOT NULL, article_promotion_id INT NOT NULL, avoir_promotion_debut DATE NOT NULL, avoir_promotion_fin DATE NOT NULL, INDEX IDX_884353FB74961937 (article_reference), INDEX IDX_884353FBC0D18605 (article_promotion_id), PRIMARY KEY(article_reference, article_promotion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (article_categorie_id INT AUTO_INCREMENT NOT NULL, image_uri VARCHAR(255) NOT NULL, article_categorie_parent_id INT DEFAULT NULL, article_categorie_nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_93488610DCF66172 (image_uri), INDEX IDX_93488610295F26B9 (article_categorie_parent_id), PRIMARY KEY(article_categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_meta (article_meta_id INT AUTO_INCREMENT NOT NULL, article_meta_nom VARCHAR(60) NOT NULL, PRIMARY KEY(article_meta_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_promotion (article_promotion_id INT AUTO_INCREMENT NOT NULL, article_promotion_pourcentage INT NOT NULL, PRIMARY KEY(article_promotion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (commande_reference INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type_paiement_id INT NOT NULL, commande_adresse_facture INT NOT NULL, commande_adresse_livraison INT NOT NULL, commande_date_creation DATETIME NOT NULL, commande_date_paiement DATETIME DEFAULT NULL, commande_date_expedition DATETIME DEFAULT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), INDEX IDX_6EEAA67D615593E9 (type_paiement_id), INDEX IDX_6EEAA67D365BBB4A (commande_adresse_facture), INDEX IDX_6EEAA67DF0342D59 (commande_adresse_livraison), PRIMARY KEY(commande_reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_avoir_article (commande_reference INT NOT NULL, article_reference VARCHAR(25) NOT NULL, commande_avoir_article_quantite INT NOT NULL, INDEX IDX_D5899390BEAF1351 (commande_reference), INDEX IDX_D589939074961937 (article_reference), PRIMARY KEY(commande_reference, article_reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (fournisseur_reference INT AUTO_INCREMENT NOT NULL, fournisseur_nom VARCHAR(60) NOT NULL, fournisseur_telephone VARCHAR(15) NOT NULL, fournisseur_email VARCHAR(180) NOT NULL, fournisseur_site VARCHAR(255) DEFAULT NULL, PRIMARY KEY(fournisseur_reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournir (fournisseur_reference INT NOT NULL, article_reference VARCHAR(25) NOT NULL, INDEX IDX_34D13A5253690576 (fournisseur_reference), INDEX IDX_34D13A5274961937 (article_reference), PRIMARY KEY(fournisseur_reference, article_reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (image_uri VARCHAR(255) NOT NULL, article_reference VARCHAR(25) DEFAULT NULL, INDEX IDX_C53D045F74961937 (article_reference), PRIMARY KEY(image_uri)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_paiement (type_paiement_id INT AUTO_INCREMENT NOT NULL, type_paiement_nom VARCHAR(255) NOT NULL, PRIMARY KEY(type_paiement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (user_id INT AUTO_INCREMENT NOT NULL, user_email VARCHAR(180) NOT NULL, roles JSON NOT NULL, user_password VARCHAR(255) NOT NULL, user_nom VARCHAR(60) NOT NULL, user_prenom VARCHAR(60) NOT NULL, user_date_naissance DATE DEFAULT NULL, user_created_at DATETIME NOT NULL, user_updated_at DATETIME DEFAULT NULL, user_sexe VARCHAR(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649550872C (user_email), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081653690576 FOREIGN KEY (fournisseur_reference) REFERENCES fournisseur (fournisseur_reference)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E666FB990BC FOREIGN KEY (article_categorie_id) REFERENCES categorie (article_categorie_id)');
        $this->addSql('ALTER TABLE article_avoir_meta ADD CONSTRAINT FK_7F35E83E74961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
        $this->addSql('ALTER TABLE article_avoir_meta ADD CONSTRAINT FK_7F35E83ED42EE24E FOREIGN KEY (article_meta_id) REFERENCES article_meta (article_meta_id)');
        $this->addSql('ALTER TABLE article_avoir_promotion ADD CONSTRAINT FK_884353FB74961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
        $this->addSql('ALTER TABLE article_avoir_promotion ADD CONSTRAINT FK_884353FBC0D18605 FOREIGN KEY (article_promotion_id) REFERENCES article_promotion (article_promotion_id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_93488610DCF66172 FOREIGN KEY (image_uri) REFERENCES image (image_uri)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_93488610295F26B9 FOREIGN KEY (article_categorie_parent_id) REFERENCES categorie (article_categorie_id)');
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

        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D365BBB4A');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF0342D59');
        $this->addSql('ALTER TABLE article_avoir_meta DROP FOREIGN KEY FK_7F35E83E74961937');
        $this->addSql('ALTER TABLE article_avoir_promotion DROP FOREIGN KEY FK_884353FB74961937');
        $this->addSql('ALTER TABLE commande_avoir_article DROP FOREIGN KEY FK_D589939074961937');
        $this->addSql('ALTER TABLE fournir DROP FOREIGN KEY FK_34D13A5274961937');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F74961937');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E666FB990BC');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_93488610295F26B9');
        $this->addSql('ALTER TABLE article_avoir_meta DROP FOREIGN KEY FK_7F35E83ED42EE24E');
        $this->addSql('ALTER TABLE article_avoir_promotion DROP FOREIGN KEY FK_884353FBC0D18605');
        $this->addSql('ALTER TABLE commande_avoir_article DROP FOREIGN KEY FK_D5899390BEAF1351');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081653690576');
        $this->addSql('ALTER TABLE fournir DROP FOREIGN KEY FK_34D13A5253690576');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_93488610DCF66172');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D615593E9');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_avoir_meta');
        $this->addSql('DROP TABLE article_avoir_promotion');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE article_meta');
        $this->addSql('DROP TABLE article_promotion');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_avoir_article');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE fournir');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE type_paiement');
        $this->addSql('DROP TABLE user');
    }
}
