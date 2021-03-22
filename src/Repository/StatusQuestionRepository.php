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
}
