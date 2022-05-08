<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Form\ProduitType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Entity\ContenuPanier;
use App\Form\ContenuPanierType;

class ProduitController extends AbstractController
{
    #[Route('/produits', name: 'app_produit')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        // Connexion à la base de données
        $em = $doctrine->getManager();
        // récupération de toutes les données
        $produit = $em->getRepository(Produit::class)->findAll();
        
        return $this->render('produit/index.html.twig', [
            'produits' => $produit,
        ]);
    }

    #[Route('/produitAdmin/{id}', name:'produit_edit_admin')]
    public function editAdmin(Produit $produit = null, Request $request, ManagerRegistry $doctrine, TranslatorInterface $translator){
        if($produit == null){
            $this->addFlash('danger', $translator->trans('JeuxIntrouvable'));
            return $this->redirectToRoute('app_produit');
        }
       
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Insertion de la photo uniquement si le form est valid et envoyé
            $photo = $form->get('photo')->getData();
        
            if ($photo) {
                $newFilename = uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('danger', $translator->trans('ImageNone'));
                    return $this->redirectToRoute('app_produit');
                }
                $produit->setPhoto($newFilename);
            }
            
            $em = $doctrine->getManager();
            $em->persist($produit);
            $em->flush();
            $this->addFlash('success', $translator->trans('JeuxUpdate'));
        }

     return $this->render('produit/modifAdmin.html.twig', [
        'editProduit' => $form->createView()
     ]);
    }

    #[Route('/produitAddAdmin', name:'produit_add_admin')]
    public function AddNew(Produit $produit = null, Request $request, ManagerRegistry $doctrine, TranslatorInterface $translator){

        // Connexion à la base de données
        $em = $doctrine->getManager();
        $produit = $em->getRepository(Produit::class)->findAll();

        $produit = new Produit();
        
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $photo = $form->get('photo')->getData();

            if ($photo) {
                $newFilename = uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('danger', $translator->trans('ImageNone'));
                    return $this->redirectToRoute('produit_add_admin');
                }

                $produit->setPhoto($newFilename);
            }
            
            $em = $doctrine->getManager();
            $em->persist($produit);
            $em->flush();
            $this->addFlash('success', $translator->trans('JeuxAjout'));
        }

     return $this->render('produit/AjoutAdmin.html.twig', [
        'ajoutProduit' => $form->createView(),
     ]);
    }

    #[Route('/produit/{id}', name:'produit_edit')]
    public function edit(Produit $produit = null, Request $request, ManagerRegistry $doctrine, TranslatorInterface $translator){
        if($produit == null){
            $this->addFlash('danger', $translator->trans('JeuxIntrouvable'));
            return $this->redirectToRoute('app_produit');
        }

        // Récupère l'utilisateur et le stocke dans une variable 
        $user = $this->getUser();

        /*
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $photo = $form->get('photo')->getData();

            if ($photo) {
                $newFilename = uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('danger', $translator->trans('ImageNone'));
                    return $this->redirectToRoute('app_produit');
                }

                $produit->setPhoto($newFilename);
            }
            
            $em = $doctrine->getManager();
            $em->persist($produit);
            $em->flush();
            $this->addFlash('success', $translator->trans('JeuxUpdate'));
        }
        */

        // Création d'un objet vide pour le formulaire
        $contenuPanier = new ContenuPanier();
        // Formulaire d'ajout du produit au panier
        $ajout = $this->createForm(ContenuPanierType::class, $contenuPanier);
        $ajout->handleRequest($request);

        // Si le formulaire est envoyé et valide
        if ($ajout->isSubmitted() && $ajout->isValid()) {

            // Récupère le produit
            $contenuPanier->setProduit($produit);
            // Récupère l'ID du panier de l'utilisateur
            $contenuPanier->setPanier($user->getPanier());

            $this->addFlash('success', '(test) form bien envoyé');
            return $this->redirectToRoute('app_panier', ['id' => $request->get('id')]);
        }

     return $this->render('produit/edit.html.twig', [
        'produit' => $produit,
        'ajoutPanier' => $ajout->createView(),
        // 'editProduit' => $form->createView()
     ]);
    }

    #[Route('/produit/delete/{id}', name:'produit_delete')]
    public function delete(Produit $produit = null, ManagerRegistry $doctrine, TranslatorInterface $translator){
        if($produit == null){
            $this->addFlash('danger', $translator->trans('JeuxIntrouvable'));
            return $this->redirectToRoute('app_produit');
        }

        $em = $doctrine->getManager();
        $em->remove($produit);
        $em->flush();

        $this->addFlash('warning', $translator->trans('JeuxSup'));
        return $this->redirectToRoute('app_produit');
    }

}
