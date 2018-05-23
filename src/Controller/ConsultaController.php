<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Consulta;
use App\Form\ConsultaType;
use Symfony\Component\HttpFoundation\Request;

/**
     * @Route("/consulta", name="")
     */
class ConsultaController extends Controller
{
    /**
     * @Route("/nuevo", name="consulta")
     */
        public function nuevo(Request $request)
    {

    	$consulta = new Consulta();
    	$formulario = $this->createForm(ConsultaType::class, $consulta);
        $formulario->handleRequest($request);
        
        if ($formulario->isSubmitted()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consulta);
            $entityManager->flush();

            return $this->redirectToRoute('consulta'); 
        }

        return $this->render('consulta/nuevo.html.twig', [
     		'formulario' => $formulario->createView(),
        ]);    
    }
}