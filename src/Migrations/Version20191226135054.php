<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191226135054 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (article_reference VARCHAR(25) NOT NULL, article_categorie_id INT NOT NULL, article_designation VARCHAR(80) NOT NULL, article_prix_ht DOUBLE PRECISION NOT NULL, article_description_courte VARCHAR(255) NOT NULL, article_description_longue LONGTEXT NOT NULL, article_minimum_stock INT NOT NULL, article_stock INT NOT NULL, INDEX IDX_23A0E666FB990BC (article_categorie_id), PRIMARY KEY(article_reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_avoir_meta (article_reference VARCHAR(25) NOT NULL, article_meta_id INT NOT NULL, INDEX IDX_7F35E83E74961937 (article_reference), INDEX IDX_7F35E83ED42EE24E (article_meta_id), PRIMARY KEY(article_reference, article_meta_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_avoir_promotion (article_reference VARCHAR(25) NOT NULL, article_promotion_id INT NOT NULL, avoir_promotion_debut DATE NOT NULL, avoir_promotion_fin DATE NOT NULL, INDEX IDX_884353FB74961937 (article_reference), INDEX IDX_884353FBC0D18605 (article_promotion_id), PRIMARY KEY(article_reference, article_promotion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_categorie (article_categorie_id INT AUTO_INCREMENT NOT NULL, image_uri VARCHAR(255) NOT NULL, article_categorie_nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_93488610DCF66172 (image_uri), PRIMARY KEY(article_categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_meta (article_meta_id INT AUTO_INCREMENT NOT NULL, article_meta_nom VARCHAR(60) NOT NULL, PRIMARY KEY(article_meta_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_promotion (article_promotion_id INT AUTO_INCREMENT NOT NULL, article_promotion_pourcentage INT NOT NULL, PRIMARY KEY(article_promotion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (image_uri VARCHAR(255) NOT NULL, article_reference VARCHAR(25) DEFAULT NULL, INDEX IDX_C53D045F74961937 (article_reference), PRIMARY KEY(image_uri)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (user_id INT AUTO_INCREMENT NOT NULL, user_email VARCHAR(180) NOT NULL, roles JSON NOT NULL, user_password VARCHAR(255) NOT NULL, user_nom VARCHAR(60) NOT NULL, user_prenom VARCHAR(60) NOT NULL, user_date_naissance DATE DEFAULT NULL, user_created_at DATETIME NOT NULL, user_updated_at DATETIME DEFAULT NULL, user_sexe VARCHAR(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649550872C (user_email), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E666FB990BC FOREIGN KEY (article_categorie_id) REFERENCES article_categorie (article_categorie_id)');
        $this->addSql('ALTER TABLE article_avoir_meta ADD CONSTRAINT FK_7F35E83E74961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
        $this->addSql('ALTER TABLE article_avoir_meta ADD CONSTRAINT FK_7F35E83ED42EE24E FOREIGN KEY (article_meta_id) REFERENCES article_meta (article_meta_id)');
        $this->addSql('ALTER TABLE article_avoir_promotion ADD CONSTRAINT FK_884353FB74961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
        $this->addSql('ALTER TABLE article_avoir_promotion ADD CONSTRAINT FK_884353FBC0D18605 FOREIGN KEY (article_promotion_id) REFERENCES article_promotion (article_promotion_id)');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_93488610DCF66172 FOREIGN KEY (image_uri) REFERENCES image (image_uri)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F74961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_avoir_meta DROP FOREIGN KEY FK_7F35E83E74961937');
        $this->addSql('ALTER TABLE article_avoir_promotion DROP FOREIGN KEY FK_884353FB74961937');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F74961937');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E666FB990BC');
        $this->addSql('ALTER TABLE article_avoir_meta DROP FOREIGN KEY FK_7F35E83ED42EE24E');
        $this->addSql('ALTER TABLE article_avoir_promotion DROP FOREIGN KEY FK_884353FBC0D18605');
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_93488610DCF66172');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_avoir_meta');
        $this->addSql('DROP TABLE article_avoir_promotion');
        $this->addSql('DROP TABLE article_categorie');
        $this->addSql('DROP TABLE article_meta');
        $this->addSql('DROP TABLE article_promotion');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE user');
    }
}
