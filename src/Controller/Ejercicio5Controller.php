<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ejercicio5Controller extends AbstractController
{
    /**
     * @Route("/ejercicio5", name="ejercicio5")
     */
    public function index(): Response
    {
        return $this->render('ejercicio5/index.html.twig');
    }

    /**
     * @Route("/ejercicio5/generar", name="generar")
     */
    public function generar(): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $usuario = new Usuario("gonzalo", "tittarelli", "gtittarelli@ips.gba.gov.ar", "gonza123");
            $post = new Post("Titulo", "este es un post");
            $usuario->addPost($post);
            $em->persist($usuario);
            $em->flush();
            return $this->render('ejercicio5/index.html.twig', [
                'exito' => 'Se genero el usuario',
            ]);
        } catch (Exception $e) {
            return $this->render('ejercicio5/index.html.twig', [
                'error' => 'Hubo un error. No se genero el usuario',
            ]);
        }
    }

    /**
     * @Route("/ejercicio5/consultar", name="consultar")
     */
    public function consultar(): Response
    {
        $repositorio_usuario = $this->getDoctrine()->getRepository(Usuario::class);
        $usuario = $repositorio_usuario->findById(2);
        $posteos = $repositorio_usuario->countPosts(2);
        $repositorio_posts = $this->getDoctrine()->getRepository(Post::class);
        $posteos_titulo = $repositorio_posts->findByTitulo('Titulo');
        return $this->render('ejercicio5/index.html.twig', [
            'usuario' => $usuario,
            'posteos' => $posteos,
        ]);
    }
}
