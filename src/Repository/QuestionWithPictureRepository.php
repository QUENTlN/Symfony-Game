<?php

namespace App\Repository;

use App\Entity\QuestionWithPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionWithPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionWithPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionWithPicture[]    findAll()
 * @method QuestionWithPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionWithPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionWithPicture::class);
    }

    public function findQuestionWithStatusPending()
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.status = :status')
            ->setParameter('status', "pending")
            ->getQuery()
            ->getResult();
    }
}
