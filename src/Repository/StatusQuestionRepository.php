<?php

namespace App\Repository;

use App\Entity\StatusQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatusQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusQuestion[]    findAll()
 * @method StatusQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusQuestion::class);
    }

    // /**
    //  * @return StatusQuestion[] Returns an array of StatusQuestion objects
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
    public function findOneBySomeField($value): ?StatusQuestion
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
