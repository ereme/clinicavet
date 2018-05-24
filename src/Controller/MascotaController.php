<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Mascota;
use App\Form\MascotaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


/**
     * @Route("/mascota", name="")
     */
class MascotaController extends Controller
{
    /**
     * @Route("/nuevo", name="mascota")
     */
        public function nuevo(Request $request)
    {

    	$mascota = new Mascota();
    	$formulario = $this->createForm(MascotaType::class, $mascota);
        $formulario->handleRequest($request);
        
        if ($formulario->isSubmitted()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mascota);
            $entityManager->flush();

            return $this->redirectToRoute('mascota'); 
        }

        return $this->render('mascota/nuevo.html.twig', [
     		'formulario' => $formulario->createView(),
        ]);    
    }

    /**
     * @Route("/jsonlist", name="cliente_jsonlist")
     */
    public function jsonClientes()
    {

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        $serializer = new Serializer(array($normalizer), array($encoder));

        $repo = $this->getDoctrine()->getRepository(Mascota::class);
        $mascotas = $repo->findAll();
        $jsonMascotas = $serializer->serialize($mascotas, 'json');        

        $respuesta = new Response($jsonMascotas);
        
        return $respuesta;
    }

    /**
     * @Route("/lista", name="mascota_lista")
     */
        public function lista(Request $request)
    {

        $repo = $this->getDoctrine()->getRepository(Mascota::class);
        $mascotas = $repo->findAll();
        return $this->render('mascota/lista.html.twig', [
            'mascotas' => $mascotas
        ]);    
    }
}
