<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Usuario;
use App\Controller\Api\AbstractApiController;
use App\Form\Type\LoginType;

class LoginController extends AbstractApiController
{

    /**
     * @Rest\Get("home", name="home")
     */
    public function home(){
        return $this->render("home/login.html.twig");      
    }

    /**
     * @Rest\Post("/api/login_check", name="login")
     */
    /*public function login(Request $request)
    {
        $form = $this->buildForm(LoginType::class);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->response($form, Response::HTTP_BAD_REQUEST);
        }
        $email = $request->get('email');
        $password = $request->get('password');

        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
        
        $usuario = $repositorio->findOneBy([
            "email" => $email,
            "password" => $password
        ]);

        if (!$usuario){            
            return $this->response(["mensaje" => 'Las credenciales ingresadas son incorrectas'], Response::HTTP_BAD_REQUEST);
        }
        $jwtManager = $this->container->get('lexik_jwt_authentication.jwt_manager');

        return $this->response(['token' => $jwtManager->create($usuario)]);

        
    }*/
}
