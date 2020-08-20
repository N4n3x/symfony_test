<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/admin/produit", name="admin_produit")
     */
    public function index()
    {
        $produitRepo = $this->getDoctrine()->getRepository(Produit::class);
        $produits = $produitRepo->findAll();

        return $this->render('admin/produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            'produits' => $produits,
        ]);
    }

    /**
     * @Route("/admin/produit/show/{slug}", name="admin_produit_show", requirements={"slug"="[a-zA-Z0-9\-]+"})
     */
    public function show(Produit $produit){
        return $this->render('admin/produit/show.html.twig', [
            'produit' => $produit
        ]);
    }

    /**
     * @Route("/admin/produit/edit/{slug}", name="admin_produit_edit", requirements={"slug"="[a-zA-Z0-9\-]+"})
     */
    public function edit(Produit $produit, Request $request){
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin_produit_show', ["slug" => $produit->getSlug()]);
        }
        return $this->render('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin/produit/add", name="admin_produit_add")
     */
    public function add(Request $request){
        // Conception du produit
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('admin_produit_show', ["slug" => $produit->getSlug()]);
        }
        return $this->render('admin/produit/add.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin/produit/delete/{slug}", name="admin_produit_delete", requirements={"slug"="[a-zA-Z0-9\-]+"}, methods="DELETE")
     */
    public function delete(Produit $produit, Request $request){

        if($this->isCsrfTokenValid('delete'.$produit->getSlug(), $request->get('_token'))){
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush();
            $this->addFlash('success', 'Le produit est supprimé');
            $this->addFlash('success', $produit->getTitre());
        }else{
            $this->addFlash('error', 'Erreur');
        }
        return $this->redirectToRoute('admin_produit');
    }

}
