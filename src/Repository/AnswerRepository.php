<?php

namespace App\Repository;

use App\Entity\Answer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Answer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answer[]    findAll()
 * @method Answer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }

    public function findRightAnswer($question,$answer)
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a.id)')
            ->Where('a.question = :question')
            ->andWhere('LOWER(a.textAnswer) = :text' )
            ->setParameter('question', $question)
            ->setParameter('text', strtolower($answer) )
            ->getQuery()
            ->getSingleScalarResult();
    }
}
