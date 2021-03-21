<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function findBySubCategories($subCategories)
    {
        return $this->createQueryBuilder('q')
            ->Where('q.subCategory IN (:subCategory)')
            ->andWhere('q.status = :status' )
            ->setParameter('subCategory', $subCategories)
            ->setParameter('status',"accepted" )
            ->getQuery()
            ->getResult();
    }

}