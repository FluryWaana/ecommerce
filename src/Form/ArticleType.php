<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\ArticleCategorie;
use App\Entity\ArticleMeta;
use App\Entity\Fournisseur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article_reference', TextType::class, [
                'required' => true,
                'label' => 'Numéro de référence'
            ])
            ->add('article_designation', TextType::class, [
                'required' => true,
                'label' => 'Désignation'
            ])
            ->add('article_prix_ht', MoneyType::class, [
                'required' => true,
                'label' => 'Prix'
            ])
            ->add('article_description_courte', TextType::class, [
                'required' => false,
                'label' => 'Description courte'
            ])
            ->add('article_description_longue', TextType::class, [
                'required' => false,
                'label' => 'Description longue'
            ])
            ->add('article_minimum_stock', NumberType::class, [
                'required' => true,
                'label' => 'Stock minimum'
            ])
            ->add('article_stock', NumberType::class, [
                'required' => true,
                'label' => 'Stock'
            ])
            ->add('categorie', EntityType::class, [
                'class'        => ArticleCategorie::class,
                'choice_label' => 'article_categorie_nom',
                'label'        => 'Catégorie',
                'required'     => true,
                'placeholder'  => 'Choisir catégorie'
            ])
            ->add('meta', EntityType::class, [
                'class'        => ArticleMeta::class,
                'choice_label' => 'article_meta_nom',
                'multiple'     => true,
                'label'        => 'Meta',
                'required'     => false
            ])
            ->add('fournisseurs', EntityType::class, [
                'class'        => Fournisseur::class,
                'choice_label' => 'fournisseur_nom',
                'multiple'     => true,
                'label'        => 'Fournisseurs',
                'required'     => false
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
