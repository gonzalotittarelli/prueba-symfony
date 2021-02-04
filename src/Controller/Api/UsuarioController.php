<?php

namespace App\Controller\Api;
use App\Entity\Usuario;
use App\Form\Type\UsuarioType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
* @Rest\Route("/api")
*/
class UsuarioController extends AbstractApiController
{
    /**
     * @Rest\Get("/usuarios")     
     */
    public function usuarios(): Response
    {        
        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
        $usuarios = $repositorio->findAll();                
        return $this->response($usuarios); 
    }

    /**
     * @Rest\Get("/usuario/{id}")     
     */
    public function usuario(Request $request): Response
    {        
        $idusuario = $request->get('id');

        if (!$idusuario){
            return $this->response(["error" => "Usuario no encontrado"], Response::HTTP_BAD_REQUEST);
        }

        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
        $usuario = $repositorio->findById($idusuario);                

        if (!$usuario){
            return $this->response(["error" => "Usuario no encontrado"], Response::HTTP_BAD_REQUEST);
        }
        return $this->response($usuario); 
    }

    /**
     * @Rest\Post("/usuario")
     */
    public function agregar(Request $request): Response
    {
        $form = $this->buildForm(UsuarioType::class);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->response($form, Response::HTTP_BAD_REQUEST);
        }
        $usuario = $form->getData();
        $this->getDoctrine()->getManager()->persist($usuario);
        $this->getDoctrine()->getManager()->flush();
        return $this->response($usuario);        
    }

    /**
     * @Rest\Delete("/usuario/{id}")
     */
    public function eliminar(Request $request): Response
    {
        $idusuario = $request->get('id');

        if (!$idusuario){
            return $this->response(["error" => "Usuario no encontrado"], Response::HTTP_BAD_REQUEST);
        }

        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
        $usuario = $repositorio->findById($idusuario);                

        if (!$usuario){
            return $this->response(["error" => "Usuario no encontrado"], Response::HTTP_BAD_REQUEST);
        }      
        $this->getDoctrine()->getManager()->remove($usuario);
        $this->getDoctrine()->getManager()->flush();
        return $this->response(["success" => sprintf('Se ha eliminado el usuario con id %s', $idusuario)]); 
    }

    /**
     * @Rest\Put("/usuario/{id}")
     */
    public function actualizar(Request $request): Response
    {
        $idusuario = $request->get('id');

        if (!$idusuario){
            return $this->response(["error" => "Usuario no encontrado"], Response::HTTP_BAD_REQUEST);
        }

        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
        $usuario = $repositorio->findById($idusuario);                

        if (!$usuario){
            return $this->response(["error" => "Usuario no encontrado"], Response::HTTP_BAD_REQUEST);
        }      

        $form = $this->buildForm(UsuarioType::class, $usuario, [
            'method' => $request->getMethod()
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->response($form, Response::HTTP_BAD_REQUEST);
        }

        $usuario = $form->getData();

        $this->getDoctrine()->getManager()->persist($usuario);
        $this->getDoctrine()->getManager()->flush();
        
        return $this->response($usuario);        
    }
}
