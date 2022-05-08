<?php

namespace App\Controller;

use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Entity\ContenuPanier;

class PanierController extends AbstractController
{
    // Affichage du panier de l'utilisateur connecté
    #[Route('/panier/{id}', name: 'app_panier')]
    public function index(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em): Response
    {
        // Récupération des params dans l'url
        $iduser = $request->attributes->get('_route_params');
        // Connexion bdd
        $em = $doctrine->getManager();
        // Première requete on récupère le panier général
        $commandes = $em->getRepository(Panier::class)->findOrderByIdNull($iduser);
        // Deuxième requete on recupère le detail du panier
        $articles = $em->getRepository(ContenuPanier::class)->findDetailById($commandes);

        // On retourne les articles dans la vues
        return $this->render('panier/index.html.twig', [
            'paniers' => $articles,
        ]);
    }

    #[Route('/panierAdd/{id}', name: 'app_panier_add')]
    public function detail(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em): Response
    {
        // Récupération des params dans l'url
        $params = $request->attributes->get('_route_params');

        // Connexion bdd
        $em = $doctrine->getManager();
        $panier = new Panier();
        
        // Mise en place du form
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        // Récupérations des params + requetes
        $iduser = $request->attributes->get('_route_params');
        $em = $doctrine->getManager();
        $commandes = $em->getRepository(Panier::class)->findOrderByIdNull($iduser);
        $articles = $em->getRepository(ContenuPanier::class)->findDetailById($commandes);

        // On retourne les articles dans la vues
        return $this->render('panier/index.html.twig', [
            'paniers' => $articles,
        ]);
    }
     
    #[Route('/panierValid', name: 'app_valid_panier')]
    public function Valid(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em): Response
    {
        return $this->render('compte/index.html.twig', []);
    }
}
