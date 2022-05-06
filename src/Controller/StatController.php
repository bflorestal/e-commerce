<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
#use App\Form\ProduitType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Contracts\Translation\TranslatorInterface;

class StatController extends AbstractController
{
    #[Route('/statistiques', name: 'app_stat')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        // Connexion à la base de données
        $em = $doctrine->getManager();
        $users = $em->getRepository(User::class)->findUserWhere();

        return $this->render('stat/index.html.twig', [
            'users' => $users,
        ]);
    }
}



