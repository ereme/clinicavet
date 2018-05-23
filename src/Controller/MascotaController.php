<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MascotaController extends Controller
{
    /**
     * @Route("/mascota", name="mascota")
     */
    public function index()
    {
        return $this->render('mascota/index.html.twig', [
            'controller_name' => 'MascotaController',
        ]);
    }
}
