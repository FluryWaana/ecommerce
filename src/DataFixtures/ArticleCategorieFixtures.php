<?php

namespace App\DataFixtures;

use App\Entity\ArticleCategorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleCategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Liste des catégories
        $categories = [ 'alimentation', 'boîtier', 'carte graphique', 'carte mère', 'carte son', 'disque dur & ssd','mémoire', 'processeur'];

        // Parcours le tableau pour remplir la BDD de catégorie
        for( $i = 0; $i < count( $categories ); $i++ )
        {
            $categorie = new ArticleCategorie();
            $categorie->setArticleCategorieNom( $categories[$i]);
            $manager->persist( $categorie );
        }

        $manager->flush();
    }
}
