<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Service\MailTestServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/mail/{slug}", name="mail")
     */
    public function mail(ProduitRepository $produitRepository, MailTestServices $email, Produit $produit){
        $produit = $produitRepository->find(120);
        // Call mailer
        $email->testSend($produit);
        return $this->redirectToRoute("default");
    }
}
