<?php

namespace App\Controller;

use App\Entity\DiscoveredPokemon;
use App\Repository\DiscoveredPokemonRepository;
use App\Repository\PokemonRepository;
use App\Repository\SpawnedPokemonRepository;
use App\Services\Spawner;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
            $discovered = $discoveredPokemonRepository->findOneBy(['pokemon' => $spawnedPokemon->getPokemon()]);

            if (null === $discovered) {
                $discovered = (new DiscoveredPokemon())
                    ->setPokemon($spawnedPokemon->getPokemon())
                ;

                $managerRegistry->getManager()->persist($discovered);
                $managerRegistry->getManager()->flush();

                $discoveredPokemons[] = $discovered;
            }
        }

        $discoveredPokemonsCount = $discoveredPokemonRepository->count([]);

        $data = compact('spawnedPokemons', 'discoveredPokemons', 'discoveredPokemonsCount');

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
            $discoveredPokemon = null;

            foreach ($discovered as $d) {
                if ($pokemon->getId() === $d->getPokemon()->getId()) {
                    $discoveredPokemon = $pokemon;
                }
            }

            $discoveredPokemons[] = [
                'pokemon' => $pokemon,
                'discovered' => null !== $discoveredPokemon
            ];
        }

        $total = $pokemonRepository->count([]);

        $data = compact('discoveredPokemons', 'total');

        return new Response($serializer->serialize($data, 'json'));
    }
}
