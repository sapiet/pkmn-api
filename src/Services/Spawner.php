<?php

namespace App\Services;

use App\Entity\Pokemon;
use App\Entity\SpawnedPokemon;
use App\Repository\PokemonRepository;
use App\Repository\SpawnedPokemonRepository;
use Doctrine\Persistence\ManagerRegistry;

class Spawner
{
    /**
     * @var PokemonRepository
     */
    private $pokemonRepository;

    /**
     * @var SpawnedPokemonRepository
     */
    private $spawnedPokemonRepository;

    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    public function __construct(
        PokemonRepository $pokemonRepository,
        SpawnedPokemonRepository $spawnedPokemonRepository,
        ManagerRegistry $managerRegistry
    ) {
        $this->pokemonRepository = $pokemonRepository;
        $this->managerRegistry = $managerRegistry;
        $this->spawnedPokemonRepository = $spawnedPokemonRepository;
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param float $distance
     * @param int $count
     * @throws \Exception
     */
    public function spawn(float $latitude, float $longitude, float $distance, int $count)
    {
        $availablePokemons = $this->pokemonRepository->findAll();

        $availablePokemons = array_filter($availablePokemons, function(Pokemon $pokemon) : bool {
            return 0 < $pokemon->getSpawnPercentage();
        });

        $pokemons = [];

        foreach ($availablePokemons as $availablePokemon) {
            if ($availablePokemon->getSpawnPercentage() > 200) {
                continue;
            }

            array_push(
                $pokemons,
                ...array_fill(0, $availablePokemon->getSpawnPercentage(), $availablePokemon)
            );
        }

        while ($count > count($this->spawnedPokemonRepository->findAround($latitude, $longitude, $distance))) {
            shuffle($pokemons);

            $index = array_rand($pokemons, 1);

            /** @var Pokemon $pokemon */
            $pokemon = $pokemons[$index];

            $endDate = (new \DateTimeImmutable())
                ->add(new \DateInterval(sprintf('PT%dS', $pokemon->getSpawnDuration())));

            $coordinates = $this->generate_random_point([$latitude, $longitude], $distance);

            $spawnedPokemon = (new SpawnedPokemon())
                ->setPokemon($pokemon)
                ->setEndDate($endDate)
                ->setLatitude($coordinates[0])
                ->setLongitude($coordinates[1])
            ;

            $this->managerRegistry->getManager()->persist($spawnedPokemon);
            $this->managerRegistry->getManager()->flush();
        }
    }

    /**
     * Given a $centre (latitude, longitude) co-ordinates and a
     * distance $radius (miles), returns a random point (latitude,longtitude)
     * which is within $radius kms of $centre.
     *
     * @param  array $centre Numeric array of floats. First element is
     *                       latitude, second is longitude.
     * @param  float $radius The radius (in kms).
     * @return array         Numeric array of floats (lat/lng). First
     *                       element is latitude, second is longitude.
     */
    function generate_random_point(array $centre, float $radius)
    {
        $radius *= 0.621371;
        $radius_earth = 3959; //miles

        //Pick random distance within $distance;
        $distance = lcg_value()*$radius;

        //Convert degrees to radians.
        $centre_rads = array_map( 'deg2rad', $centre );

        //First suppose our point is the north pole.
        //Find a random point $distance miles away
        $lat_rads = (pi()/2) -  $distance/$radius_earth;
        $lng_rads = lcg_value()*2*pi();


        //($lat_rads,$lng_rads) is a point on the circle which is
        //$distance miles from the north pole. Convert to Cartesian
        $x1 = cos( $lat_rads ) * sin( $lng_rads );
        $y1 = cos( $lat_rads ) * cos( $lng_rads );
        $z1 = sin( $lat_rads );


        //Rotate that sphere so that the north pole is now at $centre.

        //Rotate in x axis by $rot = (pi()/2) - $centre_rads[0];
        $rot = (pi()/2) - $centre_rads[0];
        $x2 = $x1;
        $y2 = $y1 * cos( $rot ) + $z1 * sin( $rot );
        $z2 = -$y1 * sin( $rot ) + $z1 * cos( $rot );

        //Rotate in z axis by $rot = $centre_rads[1]
        $rot = $centre_rads[1];
        $x3 = $x2 * cos( $rot ) + $y2 * sin( $rot );
        $y3 = -$x2 * sin( $rot ) + $y2 * cos( $rot );
        $z3 = $z2;


        //Finally convert this point to polar co-ords
        $lng_rads = atan2( $x3, $y3 );
        $lat_rads = asin( $z3 );

        return array_map( 'rad2deg', array( $lat_rads, $lng_rads ) );
    }
}
