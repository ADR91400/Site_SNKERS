<?php

namespace App\Controller;

use DateTime;
use App\Entity\Sneaker;
use App\Repository\SneakerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Ce controller contient toutes les pages de l'administration
 * des sneakers
 */
class AdminSneakerController extends AbstractController
{
    /**
     * Cette méthode affiche et créer un nouvelle sneaker
     */
    #[Route('/admin/sneakers/nouveau', name: 'app_adminSneaker_create', methods: ['GET', 'POST'])]
    public function create(Request $request, SneakerRepository $repository): Response
    {
        // On créer le formulaire de sneaker
        $form = $this->createForm(SneakerType::class);

        // Remplir le formulaire
        $form->handleRequest($request);

        // On test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére la sneaker
            $sneaker = $form->getData();

            $sneaker
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime());

            // Enregistrement dans la base de données
            $repository->save($sneaker, true);

            // Redirection vers la liste
            return $this->redirectToRoute('app_adminSneaker_list');
        }

        // Afficher la page de création d'un livre
        return $this->render('adminSneaker/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Liste des sneakers de l'application
     */
    #[Route('/admin/sneakers', name: 'app_adminSneaker_list', methods: ['GET'])]
    public function list(SneakerRepository $repository): Response
    {
        // Récupérer tout les sneakers
        $sneakers = $repository->findAll();

        // Afficher une page pour les sneakers
        return $this->render('adminSneaker/list.html.twig', [
            'books' => $sneakers,
        ]);
    }

    /**
     * Met à jour une sneaker
     */
    #[Route('/admin/sneakers/{id}', name: 'app_adminSneaker_update', methods: ['GET', 'POST'])]
    public function update(Sneaker $sneaker, Request $request, SneakerRepository $repository): Response
    {
        // Créer le formulaire
        $form = $this->createForm(SneakerType::class, $sneaker, [
            'mode' => 'update',
        ]);

        // On le remplie avec les données de la requête
        $form->handleRequest($request);

        // On test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére le livre
            $sneaker = $form->getData();

            // On met à jour la date de mise à jour
            $sneaker->setUpdatedAt(new DateTime());

            // Enregistre le livre dans la base de données
            $repository->save($sneaker, true);

            // Rediriger vers la liste
            return $this->redirectToRoute('app_adminSneaker_list');
        }

        // Afficher le formulaire
        return $this->render('adminSneaker/update.html.twig', [
            'sneaker' => $sneaker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime un livre
     */
    #[Route('/admin/livres/{id}/supprimer', name: 'app_adminBook_remove', methods: ['GET'])]
    public function remove(Book $book, BookRepository $repository): Response
    {
        // Supprimer le livre de la table
        $repository->remove($book, true);

        // Redirection vers la liste
        return $this->redirectToRoute('app_adminBook_list');
    }
}