<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\UserType;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Panier;
use App\Entity\ContenuPanier;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserController extends AbstractController
{
    // Permet l'ouverture de la vue compte/index.html.twig
    #[Route('/monCompte/{id}', name: 'app_compte')]
    public function index(Panier $user = null, Request $request, ManagerRegistry $doctrine)
    {
        // récupération de l'id en paramètre de la route
        $idUser = $request->attributes->get('_route_params');

        $idEtat = $request->attributes->get('_route_params');

        // Récupération des commandes liés à l'utilisateurs
        $ems = $doctrine->getManager();
        $usersCommande = $ems->getRepository(Panier::class)->findOrderByUser($idUser);

        $notPaid = $ems ->getRepository(Panier::class)-> notPaidOrder($idEtat);

        return $this->render('compte/index.html.twig', [
            'paniers' => $usersCommande,
            'notPaid' => $notPaid,
         ]);
    }

    // Route permettant de modifier un profil
    #[Route('/editProfile/{id}', name:'app_edit_profil')]
    public function editprofile(User $user = null, Request $request, ManagerRegistry $doctrine, TranslatorInterface $translator){
        if($user == null){
            $this->addFlash('danger', $translator->trans('userIntrouvable'));
            return $this->redirectToRoute('app_compte');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        // Verification des données saisies
        if($form->isSubmitted() && $form->isValid()){

            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', $translator->trans('CompteUpdate'));
        }

     return $this->render('compte/edit.html.twig', [
        'modifProfil' => $form->createView(),
     ]);
    }

    // Permet l'ouverture de la vue compte/commande.html.twig
    #[Route('/detail_commande/{id}', name: 'app_details_commande')]
    public function detail(Panier $user = null, Request $request, ManagerRegistry $doctrine)
    {
        // récupération de l'id en paramètre de la route
        $idCommande = $request->attributes->get('_route_params');

        // Récupération des commandes liés à l'utilisateurs
        $ems = $doctrine->getManager();
        $commandes = $ems->getRepository(Panier::class)->findOrderById($idCommande);
        $articles = $ems->getRepository(ContenuPanier::class)->findDetailById($commandes);

        return $this->render('compte/commande.html.twig', [
            'commandes' => $commandes,
            'articles' => $articles,
            ]);
    }

}



