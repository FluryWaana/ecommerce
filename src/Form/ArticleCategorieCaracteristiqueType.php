<?php

namespace App\Form;

use App\Entity\ArticleCategorie;
use App\Entity\ArticleCategorieCaracteristique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ArticleCategorieCaracteristiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article_categorie_caracteristique_nom', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer le nom',
                    ]),
                    new Length([
                        'min'        => '2',
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom doit contenir au maximum {{ limit }} caractères',
                        'max'        => 60,
                    ]),
                ]
            ])
            ->add('categories', EntityType::class, [
                'class'        => ArticleCategorie::class,
                'choice_label' => 'article_categorie_nom',
                'label'        => 'Catégorie parent',
                'required'     => false,
                'placeholder'  => 'Aucune catégorie',
                'multiple'     => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleCategorieCaracteristique::class,
        ]);
    }
}
