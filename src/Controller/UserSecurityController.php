<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserSecurityController extends AbstractController
{
    /**
     * Page permettant de connécter à un utilisateur
     */
    #[Route(path: '/connexion', name: 'app_userSecurity_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('userSecurity/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    /**
     * Page permettant de s'inscrire sur le lookbook
     */
    #[Route(path: '/déconnexion', name: 'app_userSecurity_logout', methods: ['GET', 'POST'])]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}