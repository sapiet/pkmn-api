<?php

namespace App\Repository;

use App\Entity\DiscoveredPokemon;
use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DiscoveredPokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscoveredPokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscoveredPokemon[]    findAll()
 * @method DiscoveredPokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscoveredPokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscoveredPokemon::class);
    }

    /**
     * @param Pokemon $pokemon
     * @return bool
     */
    public function discovered(Pokemon $pokemon): bool
    {
        return 0 < $this->count(compact('pokemon'));
    }

    // /**
    //  * @return DiscoveredPokemon[] Returns an array of DiscoveredPokemon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DiscoveredPokemon
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
