<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ejercicio3Controller extends AbstractController
{
    /**
     * @Route("/ejercicio3", name="ejercicio3")
     */
    public function index(): Response
    {
        return $this->render('ejercicio3/index.html.twig', [
            'var' => 'hola',
        ]);
    }
}
