<?php

namespace App\Controller;

use App\Entity\DiscoveredPokemon;
use App\Entity\Pokemon;
use App\Entity\SpawnedPokemon;
use App\Entity\SpawnedPokemonPlayer;
use App\Repository\DiscoveredPokemonRepository;
use App\Repository\PokemonRepository;
use App\Repository\SpawnedPokemonPlayerRepository;
use App\Repository\SpawnedPokemonRepository;
use App\Services\Distance;
use App\Services\Spawner;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("api", name="api")
     */
    public function list(
        Request $request,
        SerializerInterface $serializer,
        ManagerRegistry $managerRegistry,
        Spawner $spawner,
        SpawnedPokemonRepository $spawnedPokemonRepository,
        DiscoveredPokemonRepository $discoveredPokemonRepository
    ): Response {
        $distance = 0.01;
        $latitude = $request->query->get('latitude');
        $longitude = $request->query->get('longitude');

        $spawner->spawn($latitude, $longitude, $distance * 10, 10);
        $spawnedPokemons = $spawnedPokemonRepository->findAround($latitude, $longitude, $distance);

        $discoveredPokemons = [];

        foreach ($spawnedPokemons as $spawnedPokemon) {
            if (false === $discoveredPokemonRepository->discovered($spawnedPokemon->getPokemon())) {
                $discovered = (new DiscoveredPokemon())
                    ->setPokemon($spawnedPokemon->getPokemon())
                ;

                $managerRegistry->getManager()->persist($discovered);
                $managerRegistry->getManager()->flush();

                $discoveredPokemons[] = $discovered;
            }
        }

        $spawnedPokemons = array_map(function(SpawnedPokemon $spawnedPokemon): array {
            return [
                'id' => $spawnedPokemon->getId(),
                'latitude' => $spawnedPokemon->getLatitude(),
                'longitude' => $spawnedPokemon->getLongitude(),
                'pokemon' => [
                    'id' => $spawnedPokemon->getPokemon()->getId(),
                    'name' => $spawnedPokemon->getPokemon()->getName(),
                    'picture' => $spawnedPokemon->getPokemon()->getPicture(),
                    'thumbnail' => $spawnedPokemon->getPokemon()->getThumbnail(),
                ]
            ];
        }, $spawnedPokemons);

        $catchedPokemonsCount = $discoveredPokemonRepository->getCatchedCount();

        /** @todo move to service */
        $pokemonsAround = $spawnedPokemonRepository->findAround($latitude, $longitude, $distance * 100);
        $pokemonsAround = array_filter(
            $pokemonsAround,
            function(SpawnedPokemon $spawnedPokemon) use ($discoveredPokemonRepository): bool {
                return false === $discoveredPokemonRepository->discovered($spawnedPokemon->getPokemon());
            }
        );
        usort($pokemonsAround, function(SpawnedPokemon $a, SpawnedPokemon $b) use ($latitude, $longitude) : int {
            $aDistance = Distance::get($latitude, $longitude, $a->getLatitude(), $a->getLongitude());
            $bDistance = Distance::get($latitude, $longitude, $b->getLatitude(), $b->getLongitude());

            if ($aDistance > $bDistance) {
                return 1;
            }

            if ($aDistance < $bDistance) {
                return -1;
            }

            return 0;
        });
        $pokemonsAround = array_map(function(SpawnedPokemon $spawnedPokemon) {
            $pokemon = $spawnedPokemon->getPokemon();

            return [
                'id' => $pokemon->getId(),
                'name' => $pokemon->getName(),
                'thumbnail' => $pokemon->getThumbnail(),
                'latitude' => $spawnedPokemon->getLatitude(),
                'longitude' => $spawnedPokemon->getLongitude(),
                'endDate' => $spawnedPokemon->getEndDate()->format('Y-m-d H:i:s'),
            ];
        }, $pokemonsAround);
        $tmpArray = [];
        foreach ($pokemonsAround as $pokemonAround) {
            if (false === array_key_exists($pokemonAround['id'], $tmpArray)) {
                $tmpArray[$pokemonAround['id']] = $pokemonAround;
            }
        }
        $pokemonsAround = array_values($tmpArray);

        $discoveredPokemonsCount = $discoveredPokemonRepository->count([]);

        $data = compact(
            'spawnedPokemons',
            'discoveredPokemons',
            'discoveredPokemonsCount',
            'pokemonsAround',
            'catchedPokemonsCount'
        );

        return new Response($serializer->serialize($data, 'json'));
    }

    /**
     * @Route("api/discovered", name="api-discovered")
     * @param SerializerInterface $serializer
     * @param PokemonRepository $pokemonRepository
     * @param DiscoveredPokemonRepository $discoveredPokemonRepository
     * @return Response
     */
    public function discovered(
        SerializerInterface $serializer,
        PokemonRepository $pokemonRepository,
        DiscoveredPokemonRepository $discoveredPokemonRepository
    ): Response {
        $pokemons = $pokemonRepository->findAll();
        $discovered = $discoveredPokemonRepository->findBy([], ['pokemon' => 'ASC']);

        $discoveredPokemons = [];

        foreach ($pokemons as $pokemon) {
            /** @var DiscoveredPokemon $discoveredPokemon */
            $discoveredPokemon = null;
            $isCatched = false;

            foreach ($discovered as $d) {
                if ($pokemon->getId() === $d->getPokemon()->getId()) {
                    $discoveredPokemon = $pokemon;
                    $isCatched = $d->isCatched();

                    break;
                }
            }

            $discoveredPokemons[] = [
                'pokemon' => $pokemon,
                'discovered' => null !== $discoveredPokemon,
                'catched' => $isCatched,
            ];
        }

        $total = $pokemonRepository->count([]);

        $data = compact('discoveredPokemons', 'total');

        return new Response($serializer->serialize($data, 'json'));
    }

    /**
     * @Route("api/try-catch/{id}", name="api_trycatch")
     */
    public function tryCatch(
        EntityManagerInterface $entityManager,
        SpawnedPokemonRepository $spawnedPokemonRepository,
        DiscoveredPokemonRepository $discoveredPokemonRepository,
        SpawnedPokemonPlayerRepository $spawnedPokemonPlayerRepository,
        int $id
    ): Response {
        /** @var SpawnedPokemon $spawnedPokemon */
        $spawnedPokemon = $spawnedPokemonRepository->find($id);

        $catched = 8 < rand(0, 10);
        $fled = false;

        if (true === $catched) {
            /** @var DiscoveredPokemon $discovered */
            $discovered = $discoveredPokemonRepository->findOneByPokemon($spawnedPokemon->getPokemon());
            $discovered->setCatchCount($discovered->getCatchCount() + 1);

            $entityManager->flush();
        } else {
            $fled = 8 < rand(0, 10);
        }

        if (true === $fled || true === $catched) {
            $state = null;

            if (true === $fled) {
                $state = 'fled';
            } elseif (true === $catched) {
                $state = 'catched';
            }

            $spawnedPokemonPlayer = $spawnedPokemonPlayerRepository->findOneBySpawnedPokemon($spawnedPokemon);

            if (null === $spawnedPokemonPlayer) {
                $spawnedPokemonPlayer = (new SpawnedPokemonPlayer())
                    ->setSpawnedPokemon($spawnedPokemon);

                $entityManager->persist($spawnedPokemonPlayer);
            }

            $spawnedPokemonPlayer->setState($state);

            $entityManager->flush();
        }

        return $this->json([
            'catched' => $catched,
            'fled' => $fled,
        ]);
    }
}
