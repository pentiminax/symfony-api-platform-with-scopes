<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\GameRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    operations: [
        new Get(
            security: 'is_granted("ROLE_GAME_READ")'
        ),
        new Post(
            security: 'is_granted("ROLE_GAME_CREATE")'
        ),
        new GetCollection(
            security: 'is_granted("ROLE_GAME_READ")'
        ),
        new Delete(
            security: 'is_granted("ROLE_GAME_DELETE")'
        ),
        new Patch(
            security: 'is_granted("ROLE_GAME_UPDATE")'
        ),
    ]
)]
#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isMultiplayer = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $releaseDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isMultiplayer(): ?bool
    {
        return $this->isMultiplayer;
    }

    public function setMultiplayer(bool $isMultiplayer): static
    {
        $this->isMultiplayer = $isMultiplayer;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeImmutable $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }
}
