<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ejercicio6Controller extends AbstractController
{
    /**
     * @Route("/ejercicio6", name="ejercicio6")
     */
    public function index(): Response
    {
        return $this->render('ejercicio6/index.html.twig', [
            'controller_name' => 'Ejercicio6Controller',
        ]);
    }

    /**
     * @Route("/ejercicio6/home", name="home")
     */
    public function home(): Response
    {
        return $this->render('ejercicio6/home.html.twig', [
            'controller_name' => 'Ejercicio6Controller',
        ]);
    }
}
