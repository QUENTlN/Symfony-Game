<?php

namespace App\Repository;

use App\Entity\RoomSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RoomSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoomSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoomSettings[]    findAll()
 * @method RoomSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoomSettings::class);
    }


    // /**
    //  * @return RoomSettings[] Returns an array of RoomSettings objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RoomSettings
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
