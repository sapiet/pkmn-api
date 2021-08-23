<?php

namespace App\Repository;

use App\Entity\SpawnedPokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpawnedPokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpawnedPokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpawnedPokemon[]    findAll()
 * @method SpawnedPokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpawnedPokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpawnedPokemon::class);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return SpawnedPokemon[]
     * @throws \Exception
     */
    public function findAround(float $latitude, float $longitude, float $distance): array
    {
        $time = new \DateTimeImmutable();

        return $this->createQueryBuilder('s')
            ->andWhere('DISTANCE(s.latitude, s.longitude, :latitude, :longitude) < :distance')
            ->andWhere('s.endDate >= :time')
            ->andWhere('s.startDate <= :time')
            ->setParameters(compact('latitude', 'longitude', 'distance', 'time'))
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return SpawnedPokemon[] Returns an array of SpawnedPokemon objects
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
    public function findOneBySomeField($value): ?SpawnedPokemon
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
