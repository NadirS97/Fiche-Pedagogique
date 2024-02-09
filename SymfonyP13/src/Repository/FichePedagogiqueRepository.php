<?php

namespace App\Repository;

use App\Entity\FichePedagogique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FichePedagogique|null find($id, $lockMode = null, $lockVersion = null)
 * @method FichePedagogique|null findOneBy(array $criteria, array $orderBy = null)
 * @method FichePedagogique[]    findAll()
 * @method FichePedagogique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FichePedagogiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FichePedagogique::class);
    }

    // /**
    //  * @return FichePedagogique[] Returns an array of FichePedagogique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FichePedagogique
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
