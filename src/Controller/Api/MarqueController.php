<?php

namespace App\Controller\Api;

use App\Entity\Marque;
use App\Repository\MarqueRepository;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarqueController extends AbstractController
{
    /**
     * @Route("/api/marque/getall", name="api_marque_getall", methods={"GET"})
     */
    public function getAll(MarqueRepository $mr): Response{

        $marques = $mr->findAll();
        // dd($marques);
        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->serialize($marques, 'json', SerializationContext::create()->setGroups("default"));
//        dd($data);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/marque/put/{id}", name="api_marque_put", methods={"PUT"})
     */
    public function put(Request $request, MarqueRepository $mr, Marque $marque): Response{
//        dd($request->request->get("nom"));
//        $id = $request->query->get("id");
//        $marque = $mr->find($id);
//        $test = (array)$marque;
//        if(!$test){
            $marque->setNom($request->request->get("nom"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($marque);
            $em->flush();
//        }

        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->serialize($marque, 'json', SerializationContext::create()->setGroups("default"));
//        dd($data);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
