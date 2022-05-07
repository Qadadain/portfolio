<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Symfony\Component\Uid\Ulid;
use Doctrine\ORM\Mapping\Id;

#[ORM\Entity]
class Technology
{
    #[Id]
    #[Column(type: 'ulid', unique: true)]
    #[GeneratedValue(strategy: 'NONE')]
    private Ulid $identifier;

    #[ORM\Column(type: Types::STRING, length: 180)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 7, nullable: true)]
    private ?string $color;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $slug;

    #[ORM\OneToMany(mappedBy: 'identifier', targetEntity: Post::class)]
    private Technology $technologies;

    public function getIdentifier(): Ulid
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
}