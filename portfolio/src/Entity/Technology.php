<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use \Doctrine\Common\Collections\Collection as Collection;
use Symfony\Component\Uid\Ulid;
use Doctrine\ORM\Mapping\Id;

#[ORM\Entity]
class Technology
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $identifier;

    #[ORM\Column(type: Types::STRING, length: 180)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 9, nullable: true)]
    private ?string $color;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $slug;

    #[ORM\OneToMany(mappedBy: 'identifier', targetEntity: Post::class)]
    private Collection $technologies;

    public function __toString(): string
    {
        return $this->name;
    }

    public function getIdentifier(): int
    {
        return $this->identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setName(string $name): void
    {
         $this->name = $name;
    }

    public function setColor(?string $color): void
    {
         $this->color = $color;
    }

    public function setSlug(?string $slug): void
    {
         $this->slug = $slug;
    }

    public function setTechnologies(Collection $technologies): void
    {
        $this->technologies = $technologies;
    }
}