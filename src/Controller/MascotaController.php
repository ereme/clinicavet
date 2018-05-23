<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Mascota;
use App\Form\MascotaType;
use Symfony\Component\HttpFoundation\Request;

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
}
