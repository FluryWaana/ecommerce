<?php

namespace App\Form;

use App\Entity\ArticleCategorie;
use App\Entity\ArticleCategorieCaracteristique;
use App\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticleCategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article_categorie_nom', TextType::class, [
                'required' => true,
                'label'    => 'Nom de la catégorie'
            ])
            ->add('image_uri', FileType::class, [
                'required'     => false,
                'mapped'       => false,
                'constraints'  => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Seuls les formats JPEG, JPG et PNG sont autorisé'
                    ])
                ]
            ])
            ->add('articleCategorie', EntityType::class, [
                'class'        => ArticleCategorie::class,
                'choice_label' => 'article_categorie_nom',
                'label'        => 'Catégorie parent',
                'required'     => false,
                'placeholder'  => 'Aucune catégorie parent'
            ])
            ->add('caracteristiques', EntityType::class, [
                'class'        => ArticleCategorieCaracteristique::class,
                'choice_label' => 'article_categorie_caracteristique_nom',
                'label'        => 'Choix des caractéristiques',
                'required'     => false,
                'placeholder'  => 'Aucune catégorie parent',
                'multiple'     => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleCategorie::class,
        ]);
    }
}
