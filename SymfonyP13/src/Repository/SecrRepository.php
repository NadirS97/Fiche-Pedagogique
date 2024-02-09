<?php

namespace App\Repository;

use App\Entity\Secr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Secr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Secr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Secr[]    findAll()
 * @method Secr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Secr::class);
    }

    // /**
    //  * @return Secr[] Returns an array of Secr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Secr
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
