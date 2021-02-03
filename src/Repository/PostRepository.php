<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @return Post[] retorna un arreglo con todos los posts con el titulo
    */
    
    public function findByTitulo($titulo)
    {
        $query = $this->getEntityManager()->createQuery('SELECT p FROM App:Post p WHERE p.titulo = :titulo');
        $query->setParameter('titulo', $titulo);
        return $query->getResult();
    } 
}
