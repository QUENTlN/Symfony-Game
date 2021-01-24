<?php

namespace App\Repository;

use App\Entity\GuessThe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GuessThe|null find($id, $lockMode = null, $lockVersion = null)
 * @method GuessThe|null findOneBy(array $criteria, array $orderBy = null)
 * @method GuessThe[]    findAll()
 * @method GuessThe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuessTheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GuessThe::class);
    }

    // /**
    //  * @return GuessThe[] Returns an array of GuessThe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GuessThe
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
