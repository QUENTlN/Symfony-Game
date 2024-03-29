<?php

namespace App\Repository;

use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }


    /**
     * @return Room[] Returns an array of Room objects
     */
    public function findAllPublicRoom()
    {
        return $this->createQueryBuilder('r')
            ->select('r, (SELECT count(s.id) FROM \App\Entity\Score AS s WHERE r=s.room) AS HIDDEN nbPlayer')
            ->where('r.isPrivate = false')
            ->orderBy('nbPlayer', 'DESC')
            ->getQuery()
            ->execute();
    }

    public function findNumberRoom(): ?int
    {
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findNumberRoomActive(): ?int
    {
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->andWhere('r.finishedAt is NULL')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
