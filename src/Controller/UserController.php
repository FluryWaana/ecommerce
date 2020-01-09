<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AddAdresseFormType;
use App\Form\UserInformationFormType;
use App\Form\UserPasswordFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/compte", name="user_account")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function index(Request $request) : Response
    {
        // Récupération de l'utilisateur
        $user = $this->getUser();

        $form = $this->createForm(UserInformationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_account');
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/mot-de-passe", name="user_password")
     * @param Request $request
     * @return Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws \Symfony\Component\Form\Exception\RuntimeException
     */
    public function indexPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder) : Response
    {
        // Récupération de l'utilisateur
        $user = $this->getUser();

        $form = $this->createForm(UserPasswordFormType::class, $user);
        $form->handleRequest($request);

        //$encoderService = $this->container->get('');
        //$match = $passwordEncoder->isPasswordValid($user->getPassword(), $form->get('old_password'));

        // Vérification du mot de passe
        //if( ! $match )
        //{
        //    $form->addError(new FormError('L\'ancien mot de passe ne correspond pas'));
        //}

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUserPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('user_password')->getData()
                )
            );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_account');
        }

        return $this->render('user/password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/adresses", name="user_adresses")
     */
    public function indexAdresses(Request $request) : Response
    {
        return $this->render('user/adresse.html.twig', [
            'adresses' => $this->getUser()->getAdresses()
        ]);
    }

    /**
     * @Route("/compte/adresse/ajout", name="user_add_adresse")
     */
    public function addAdresse(Request $request) : Response
    {
        // Récupération de l'utilisateur
        $user = $this->getUser();

        $adresse = new Adresse();
        $form = $this->createForm(AddAdresseFormType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('user_adresses');
        }

        return $this->render('user/adresse-add.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
