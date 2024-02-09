<?php

namespace App\Repository;

use App\Entity\Respo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Respo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Respo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Respo[]    findAll()
 * @method Respo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RespoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Respo::class);
    }

    // /**
    //  * @return Respo[] Returns an array of Respo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Respo
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
