<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserController extends AbstractController
{
    // Permet l'ouverture de la vue compte/index.html.twig
    #[Route('/monCompte', name: 'app_compte')]
    public function index()
    {
        return $this->render('compte/index.html.twig');
    }
}



