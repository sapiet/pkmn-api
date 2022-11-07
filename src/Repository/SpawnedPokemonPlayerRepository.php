<?php

namespace App\Repository;

use App\Entity\SpawnedPokemonPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpawnedPokemonPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpawnedPokemonPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpawnedPokemonPlayer[]    findAll()
 * @method SpawnedPokemonPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpawnedPokemonPlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpawnedPokemonPlayer::class);
    }

    // /**
    //  * @return SpawnedPokemonPlayer[] Returns an array of SpawnedPokemonPlayer objects
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
    public function findOneBySomeField($value): ?SpawnedPokemonPlayer
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
