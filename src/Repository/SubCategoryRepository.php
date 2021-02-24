<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Game;
use App\Entity\SubCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubCategory[]    findAll()
 * @method SubCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubCategory::class);
    }

    public function findByGameQuery($game)
    {
        return $this->createQueryBuilder('sc')
            ->from(Category::class, 'c')
            ->from(Game::class, 'g')
            ->where("sc.category=c")
            ->andWhere("c.game = g")
            ->andWhere("g.name = :quiz")
            ->setParameter(':quiz', $game);
    }

    public function findAllQuery()
    {
        return $this->createQueryBuilder('sc');
    }

}
