<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Cliente;
use App\Entity\Consulta;
use App\Entity\Mascota;
use App\Form\ClienteType;
use App\Form\MascotaType;
use App\Form\ConsultaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/cliente", name="")
 */
class ClienteController extends Controller
{
    /**
     * @Route("/index", name="cliente")
     */
    public function index(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Cliente::class);

        $vectorclientes = $repo->findAll();

        $cliente = new Cliente();
        $formulario = $this->createForm(ClienteType::class, $cliente);
        $formulario->handleRequest($request);
        
        if ($formulario->isSubmitted()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cliente);
            $entityManager->flush();

            return $this->redirectToRoute('cliente'); 
        }

        return $this->render('cliente/index.html.twig', [
            'vectorclientes' => $vectorclientes,
            'formulario' => $formulario->createView()
        ]);
    }


	/**
     * @Route("/detalle/{id}", name="cliente_detalle")
     */
    public function detalle(Cliente $cliente, Request $request): Response
    {
        $consulta = new Consulta();
        $formu = $this->createForm(ConsultaType::class, $consulta);
        $formu->handleRequest($request);
        
        if ($formu->isSubmitted()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consulta);
            $entityManager->flush();

            return $this->redirectToRoute('cliente_nuevo'); 
        }

        $mascota = new Mascota();
        $formulario = $this->createForm(MascotaType::class, $mascota);
        $formulario->handleRequest($request);
        
        if ($formulario->isSubmitted()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mascota);
            $entityManager->flush();

            return $this->redirectToRoute('cliente_nuevo'); 
        }

        return $this->render('cliente/detalle.html.twig', [
            'cliente' => $cliente,
            'formu' => $formu->createView(),
            'formulario' => $formulario->createView()
        ]);
    }
    


    /**
     * @Route("/nuevo", name="cliente_nuevo")
     */
    public function nuevo(Request $request)
    {

    	$cliente = new Cliente();
    	$formulario = $this->createForm(ClienteType::class, $cliente);
        $formulario->handleRequest($request);
        
        if ($formulario->isSubmitted()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cliente);
            $entityManager->flush();

            return $this->redirectToRoute('cliente'); 
        }

        
        return $this->render('cliente/nuevo.html.twig', [
     		'formulario' => $formulario->createView()
        ]);    
    }

    /**
     * @Route("/gasto", name="cliente_gasto")
     */
    public function gasto(Request $request)
    {


        
        return $this->render('cliente/gasto.html.twig', [
        ]);    
    }
}
 
