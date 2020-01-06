<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article_reference')
            ->add('article_designation')
            ->add('article_prix_ht')
            ->add('article_description_courte')
            ->add('article_description_longue')
            ->add('article_minimum_stock')
            ->add('article_stock')
            ->add('categorie')
            ->add('meta')
            ->add('fournisseurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
