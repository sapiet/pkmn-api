<?php

namespace App\Entity;

use App\Repository\SpawnedPokemonPlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpawnedPokemonPlayerRepository::class)
 */
class SpawnedPokemonPlayer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SpawnedPokemon::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $spawnedPokemon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpawnedPokemon(): ?SpawnedPokemon
    {
        return $this->spawnedPokemon;
    }

    public function setSpawnedPokemon(?SpawnedPokemon $spawnedPokemon): self
    {
        $this->spawnedPokemon = $spawnedPokemon;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }
}
