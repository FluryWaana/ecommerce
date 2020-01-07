<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_email', EmailType::class, [
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
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Utilisateur' => 'ROLE_USER' ],
                'multiple' => true
            ])
            ->add('user_password', PasswordType::class, [
                'label' => 'Mot de passe',
                'required' => false,
                'constraints'     => [
                    new NotBlank([
                        'message' => 'Entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
                        'max'        => 4096
                    ])
                ]
            ])
            ->add('user_nom', TextType::class, [
                'label' => 'Nom',
                'required'    => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre nom',
                    ]),
                    new Length([
                        'min'        => '2',
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom doit contenir au maximum {{ limit }} caractères',
                        'max'        => 60,
                    ]),
                ]
            ])
            ->add('user_prenom', TextType::class,[
                'label'       => 'Prénom',
                'required'    => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre prénom',
                    ]),
                    new Length([
                        'min'        => '2',
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le prénom doit contenir au maximum {{ limit }} caractères',
                        'max'        => 60,
                    ]),
                ]
            ])
            ->add('user_date_naissance', BirthdayType::class,[
                'label'     => 'Anniversaire (facultatif)',
                'required'  => false,
                'format' => 'dd MM yyyy',
            ])
            ->add('user_sexe',ChoiceType::class,[
                'choices' => [
                    'M.'  => 'm',
                    'Mme' => 'f'
                ],
                'label'     => false,
                'multiple'  => false,
                'expanded'  => true,
                'required'  => true,
                'attr'      => [
                    'class' => 'd-flex justify-content-center'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
