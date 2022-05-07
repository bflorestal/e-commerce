<?php

namespace App\Controller;

use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class PanierController extends AbstractController
{

    #[Route('/panier', name: 'app_panier')]
    public function index(EntityManagerInterface $em): Response
    {
        // Récupération de la table Panier
        $paniers = $em->getRepository(Panier::class)->findAll();

        return $this->render('panier/index.html.twig', [
            'paniers' => $paniers,
        ]);
    }

    #[Route('/panierAdd/{id}', name: 'app_panier_add')]
    public function detail(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em): Response
    {
        $params = $request->attributes->get('_route_params');

        // Récupération de la table Panier
        //$paniers = $em->getRepository(Panier::class)->findAll();

        return $this->render('panier/index.html.twig', [
            'params' => $params,
        ]);
    }
    
}
