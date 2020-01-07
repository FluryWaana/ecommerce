<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class PanierAddArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article_reference', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'La référence de l\'article est obligatoire',
                    ]),
                ]
            ])
            ->add('article_quantite', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'La quantité de l\'article est obligatoire',
                    ]),
                    new Positive([
                        'message' => 'La quantité de l\'article doit être supérieur à 0'
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // enable/disable CSRF protection for this form
            'csrf_protection' => false
        ]);
    }
}
