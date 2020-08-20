<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Service\MailTestServices;

use Doctrine\ORM\EntityManagerInterface;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="produit")
     */
    public function index(ProduitRepository $pr,PaginatorInterface $paginator, Request $request)
    {
        $produitRepo = $pr->findAll();
        $produits = $paginator->paginate($produitRepo,$request->query->getInt('page',1),10);

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    /**
     * @Route("/produit/show/{slug}", name="produit_show", requirements={"slug"="[a-zA-Z0-9\-]+"})
     */
    public function show(Produit $produit){
        return $this->render('produit/show.html.twig', [
            'produit' => $produit
        ]);
    }

    /**
     * @Route("/produit/contact/{slug}", name="produit_contact", requirements={"slug"="[a-zA-Z0-9\-]+"})
     */
    public function contact(Produit $produit, Request $request, MailTestServices $mail){
        $msg = new Message();
        $form = $this->createFormBuilder($msg)
            ->add('mail_client', TextType::class)
            ->add('corps', TextType::class)
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // Send mail
            $mail->testSend($produit, $msg);
            return $this->redirectToRoute('produit_show', ["slug" => $produit->getSlug()]);
        }
        return $this->render('produit/contact.html.twig', [
            'form' => $form->createView(),
            'produit' => $produit
        ]);
    }


    /**
     * @Route("/produit/mail/{slug}", name="produit_mail", requirements={"slug"="[a-zA-Z0-9\-]+"})
     */
    public function mail(MailTestServices $email, Produit $produit){


        return $this->redirectToRoute("default");
    }
}
