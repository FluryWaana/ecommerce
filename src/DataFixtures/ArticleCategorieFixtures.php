<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\ArticleCategorie;
use App\Entity\Image;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ArticleCategorieFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    //------------------------------------------------------------------------

    /**
     * ArticleCategorieFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    //------------------------------------------------------------------------
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        /**
         * Création de fausses données
         */
        //--------------------------------------------------------------------
        // Toutes les images disponibles pour les catégories
        $images_url = [
            'alimentation.png',
            'boitier-ordinateur.jpg',
            'carte-graphique.jpg',
            'carte-mere.jpg',
            'carte-son.jpg',
            'ssd.jpg',
            'ram.jpg',
            'processeur.png',
            'composant_informatique.jpg',
            'ordinateur.jpg',
            'ordinateur_portable.jpg',
            'ordinateur_bureautique.jpeg',
            'ordinateur gaming.jpg'
        ];

        // Toutes les catégories disponibles sur le site
        $categories = [
            'composants' => [
                'image_url' => 'images/composant_informatique.jpg',
                'enfants' => [
                    'alimentation' => [
                        'caracteristique' => [
                            'marque', 'modèle', 'puissance', 'certification 80 PLUS'
                        ],
                        'image_url' => 'images/alimentation.png',
                        'enfants' => []
                    ],
                    'boîtier' => [
                        'caracteristique' => [
                            'marque', 'modèle', 'puissance', 'certification 80 PLUS'
                        ],
                        'image_url' => 'images/boitier-ordinateur.jpg',
                        'enfants' => []
                    ],
                    'carte graphique' => [
                        'caracteristique' => [
                            'marque', 'modèle', 'puissance', 'certification 80 PLUS'
                        ],
                        'image_url' => 'images/carte-graphique.jpg',
                        'enfants' => []
                    ],
                    'carte mère' => [
                        'caracteristique' => [
                            'marque', 'modèle', 'puissance', 'certification 80 PLUS'
                        ],
                        'image_url' => 'images/carte-mere.jpg',
                        'enfants' => []
                    ],
                    'carte son' => [
                        'caracteristique' => [
                            'marque', 'modèle', 'puissance', 'certification 80 PLUS'
                        ],
                        'image_url' => 'images/carte-son.jpg',
                        'enfants' => []
                    ],
                    'disque dur & ssd' => [
                        'caracteristique' => [
                            'marque', 'modèle', 'puissance', 'certification 80 PLUS'
                        ],
                        'image_url' => 'images/ssd.jpg',
                        'enfants' => []
                    ],
                    'mémoire' => [
                        'caracteristique' => [
                            'marque', 'modèle', 'puissance', 'certification 80 PLUS'
                        ],
                        'image_url' => 'images/ram.jpg',
                        'enfants' => []
                    ],
                    'processeur' => [
                        'caracteristique' => [
                            'marque', 'modèle', 'puissance', 'certification 80 PLUS'
                        ],
                        'image_url' => 'images/processeur.png',
                        'enfants' => []
                    ]
                ]
            ],
            'ordinateurs' => [
                'image_url' => 'images/ordinateur.jpg',
                'enfants' => [
                    'ordinateur gaming' => [
                        'image_url' => 'images/ordinateur gaming.jpg',
                        'enfants' => []
                    ],
                    'ordinateur bureautique' => [
                        'image_url' => 'images/ordinateur_bureautique.jpeg',
                        'enfants' => []
                    ],
                    'ordinateur portable' => [
                        'image_url' => 'images/ordinateur_portable.jpg',
                        'enfants' => []
                    ]
                ]
            ]
        ];

        //--------------------------------------------------------------------

        /**
         * Création des images
         */
        for ($i = 0; $i < count( $images_url ); $i++)
        {
            $image = new Image();
            $image->setImageUri('images/' . $images_url[$i]);
            $manager->persist( $image );
        }

        //--------------------------------------------------------------------

        /**
         * Création des catégories && des articles
         */
        $this->creerCategories( $manager, $categories );

        //--------------------------------------------------------------------

        /**
         * Création des utilisateurs de "base"
         */
        for ( $l = 0; $l < 10; $l++ )
        {
            $user = new User();
            $user->setUserNom( $faker->lastName );
            $user->setUserPrenom( $faker->firstName );
            $user->setUserSexe('f');
            $user->setUserEmail( $faker->email );
            $user->setUserPassword( $this->passwordEncoder->encodePassword( $user, '123456' ) );
            $user->setUserCreatedAt( new DateTime('now') );
            $manager->persist( $user );
        }

        /**
         * Création des administrateurs
         */
        $admins = ['maxime', 'axel'];
        for ( $m = 0; $m < count( $admins ); $m++ )
        {
            $user = new User();
            $user->setUserNom( $faker->lastName );
            $user->setUserPrenom( $admins[$m] );
            $user->setUserSexe('h');
            $user->setUserEmail($admins[$m] . '@email.com');
            $user->setUserPassword( $this->passwordEncoder->encodePassword($user, '123456') );
            $user->setUserCreatedAt( new DateTime('now') );
            $user->setRoles( ['ROLE_ADMIN'] );
            $manager->persist( $user );
        }

        $manager->flush();
    }

    //------------------------------------------------------------------------

    /**
     * Créer une catégorie
     * @param ObjectManager $manager
     * @param array $categories
     * @param ArticleCategorie|null $parent
     */
    private function creerCategories( ObjectManager $manager, array $categories, ArticleCategorie $parent = null )
    {
        $repo_image = $manager->getRepository(Image::class);

        // Parcours la liste des catégories "principales"
        foreach ($categories as $key => $value) {
            // Créer une catégorie
            $categorie = new ArticleCategorie();
            $categorie->setArticleCategorieNom($key);
            $categorie->setImageUri( $repo_image->find( $value['image_url'] ) );
            (!is_null($parent)) ? $categorie->setArticleCategorie($parent) : null;
            $manager->persist($categorie);

            if ( count( $value['enfants'] ) > 0 )
            {
                $this->creerCategories( $manager, $value['enfants'], $categorie );
            }
            else
            {
                $this->creerArticles( $manager, $categorie );
            }
        }
    }

    //------------------------------------------------------------------------

    /**
     * Créer une liste d'article (20 à 100 articles par catégorie)
     * @param ObjectManager $manager
     * @param ArticleCategorie $categorie
     */
    private function creerArticles( ObjectManager $manager, ArticleCategorie $categorie )
    {
        $faker = Faker\Factory::create('fr_FR');
        /**
         * Création des articles dans une catégorie
         */
        for ( $k = 0; $k < rand( 20, 100 ); $k++ )
        {
            $article = new Article();
            $article->setArticleReference( $faker->isbn13 );
            $article->setCategorie( $categorie );
            $article->setArticleDesignation( $faker->sentence(6, true ) );
            $article->setArticlePrixHt( $faker->randomNumber(2));
            $article->setArticleDescriptionCourte( $faker->sentence(20, true ) );
            $article->setArticleDescriptionLongue( $faker->paragraphs(5, true ) );
            $article->setArticleMinimumStock( $faker->randomNumber(1 ) );
            $article->setArticleStock( $faker->randomNumber(3 ) );
            $manager->persist( $article );
        }
    }
}
