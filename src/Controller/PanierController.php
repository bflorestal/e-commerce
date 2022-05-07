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

    #[Route('/panier/{id}', name: 'app_panier')]
    public function index(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em): Response
    {
        $iduser = $request->attributes->get('_route_params');
        $em = $doctrine->getManager();
        $commandes = $em->getRepository(Panier::class)->findOrderByIdNull($iduser);
        $articles = $em->getRepository(ContenuPanier::class)->findDetailById($commandes);

        return $this->render('panier/index.html.twig', [
            'paniers' => $articles,
        ]);
    }

    #[Route('/panierAdd/{id}', name: 'app_panier_add')]
    public function detail(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em): Response
    {
        $params = $request->attributes->get('_route_params');

        // Connexion à la base de données
        $em = $doctrine->getManager();
        $panier = new Panier();
        
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        $iduser = $request->attributes->get('_route_params');
        $em = $doctrine->getManager();
        $commandes = $em->getRepository(Panier::class)->findOrderByIdNull($iduser);
        $articles = $em->getRepository(ContenuPanier::class)->findDetailById($commandes);

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
