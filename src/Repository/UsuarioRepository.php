<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Usuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuario[]    findAll()
 * @method Usuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }

    /**
     * @return Usuario a partir del id
    */    
    public function findById($id)
    {
        $query = $this->getEntityManager()->createQuery('SELECT u FROM App:Usuario u WHERE u.id = :id');
        $query->setParameter('id', $id);
        return $query->getOneOrNullResult();
    }

    /**
     * @return int cantidad de posteos del usuario
    */    
    public function countPosts($id)
    {
        $query = $this->getEntityManager()->createQuery('SELECT COUNT(DISTINCT p.id) FROM App:Usuario u JOIN u.posts p WHERE u.id = :id');
        $query->setParameter('id', $id);
        return $query->getSingleScalarResult();
    }
    
}
