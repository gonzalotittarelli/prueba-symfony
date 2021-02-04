<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Usuario;
use App\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LoginController extends Controller
{

    /**
     * @Rest\Post("/api/login_check", name="login")
    */
    public function login(Request $request)
    {        
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

        $authenticationSuccessHandler = $this->container->get('lexik_jwt_authentication.handler.authentication_success');

        return new JsonResponse(['token' => $authenticationSuccessHandler->handleAuthenticationSuccess($usuario)]);
    }
}
