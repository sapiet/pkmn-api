<?php

namespace App\Entity;

use App\Repository\DiscoveredPokemonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiscoveredPokemonRepository::class)
 */
class DiscoveredPokemon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Pokemon::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pokemon;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $catchCount = 0;

    public function __construct()
    {
        $this->creationDate = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPokemon(): ?Pokemon
    {
        return $this->pokemon;
    }

    public function setPokemon(?Pokemon $pokemon): self
    {
        $this->pokemon = $pokemon;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getCatchCount(): ?int
    {
        return $this->catchCount;
    }

    public function setCatchCount(int $catchCount): self
    {
        $this->catchCount = $catchCount;

        return $this;
    }

    public function isCatched(): bool
    {
        return 0 < $this->catchCount;
    }
}
