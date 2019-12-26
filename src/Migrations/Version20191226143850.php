<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191226143850 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande_avoir_article (commande_reference INT NOT NULL, article_reference VARCHAR(25) NOT NULL, commande_avoir_article_quantite INT NOT NULL, INDEX IDX_D5899390BEAF1351 (commande_reference), INDEX IDX_D589939074961937 (article_reference), PRIMARY KEY(commande_reference, article_reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_avoir_article ADD CONSTRAINT FK_D5899390BEAF1351 FOREIGN KEY (commande_reference) REFERENCES commande (commande_reference)');
        $this->addSql('ALTER TABLE commande_avoir_article ADD CONSTRAINT FK_D589939074961937 FOREIGN KEY (article_reference) REFERENCES article (article_reference)');
        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE commande_avoir_article');
        $this->addSql('ALTER TABLE article CHANGE article_reference article_reference VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE image CHANGE image_uri image_uri VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
