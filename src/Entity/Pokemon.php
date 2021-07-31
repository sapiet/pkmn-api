<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\DBAL\Schema\Column;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PokemonRepository::class)
 */
class Pokemon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $spawnPercentage = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $spawnDuration = 120;

    private $picture;

    private $thumbnail;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSpawnPercentage(): int
    {
        return $this->spawnPercentage;
    }

    public function setSpawnPercentage($spawnPercentage): self
    {
        $this->spawnPercentage = $spawnPercentage;

        return $this;
    }

    public function getSpawnDuration(): int
    {
        return $this->spawnDuration;
    }

    public function setSpawnDuration($spawnDuration): self
    {
        $this->spawnDuration = $spawnDuration;

        return $this;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail($thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}
