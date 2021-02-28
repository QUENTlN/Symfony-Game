<?php

namespace App\Repository;

use App\Entity\QuestionWithText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionWithText|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionWithText|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionWithText[]    findAll()
 * @method QuestionWithText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionWithTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionWithText::class);
    }


    public function findQuestionWithStatusPending()
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.status = :status')
            ->setParameter('status', "pending")
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return QuestionWithText[] Returns an array of QuestionWithText objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionWithText
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}