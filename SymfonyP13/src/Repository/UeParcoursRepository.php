<?php

namespace App\Repository;

use App\Entity\UeParcours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UeParcours|null find($id, $lockMode = null, $lockVersion = null)
 * @method UeParcours|null findOneBy(array $criteria, array $orderBy = null)
 * @method UeParcours[]    findAll()
 * @method UeParcours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UeParcoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UeParcours::class);
    }

    // /**
    //  * @return UeParcours[] Returns an array of UeParcours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UeParcours
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
