<?php

namespace App\Repository;

use App\Entity\SubTheme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubTheme|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubTheme|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubTheme[]    findAll()
 * @method SubTheme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubTheme::class);
    }

    // /**
    //  * @return SubTheme[] Returns an array of SubTheme objects
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
    public function findOneBySomeField($value): ?SubTheme
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
