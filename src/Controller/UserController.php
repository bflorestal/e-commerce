<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\UserType;
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

    #[Route('/editProfile/{id}', name:'app_edit_profil')]
    public function editprofile(User $user = null, Request $request, ManagerRegistry $doctrine, TranslatorInterface $translator){
        if($user == null){
            $this->addFlash('danger', $translator->trans('userIntrouvable'));
            return $this->redirectToRoute('app_compte');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', $translator->trans('CompteUpdate'));
        }

     return $this->render('compte/edit.html.twig', [
        'modifProfil' => $form->createView()
     ]);
    }
}



