<?php

namespace App\Repository;

use App\Entity\Listes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Listes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Listes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Listes[]    findAll()
 * @method Listes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Listes::class);
    }

    // /**
    //  * @return Listes[] Returns an array of Listes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Listes
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
