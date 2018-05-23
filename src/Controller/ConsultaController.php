<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConsultaController extends Controller
{
    /**
     * @Route("/consulta", name="consulta")
     */
    public function index()
    {
        return $this->render('consulta/index.html.twig', [
            'controller_name' => 'ConsultaController',
        ]);
    }
}
