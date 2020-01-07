<?php

namespace App\Form;

use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fournisseur_nom', TextType::class, [
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
            ->add('fournisseur_telephone', TextType::class, [
                'required' => true,
                'label' => 'Telephone',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer le telephone',
                    ]),
                    new Length([
                        'min'        => '10',
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom doit contenir au maximum {{ limit }} caractères',
                        'max'        => 10,
                    ]),
                ]
            ])
            ->add('fournisseur_email', EmailType::class, [
                'label'       => 'Adresse e-mail',
                'required'    => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer une adresse e-mail',
                    ]),
                    new Length([
                        'maxMessage' => 'L\'adresse e-mail doit contenir au maximum {{ limit }} caractères',
                        'max'        => 4096
                    ]),
                    new Email([
                        'message' => 'Ceci n\'est pas une adresse e-mail'
                    ])
                ]
            ])
            ->add('fournisseur_site', TextType::class, [
                'required' => true,
                'label' => 'Site'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fournisseur::class,
        ]);
    }
}
