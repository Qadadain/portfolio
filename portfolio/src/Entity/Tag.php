<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'blog_tag')]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER, )]
    private int $identifier;

    #[ORM\Column(type: Types::STRING, unique: true, nullable: false)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 9, nullable: false)]
    private string $color;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $slug;

    #[ORM\ManyToMany(targetEntity: Post::class, mappedBy: 'tags')]
    #[ORM\JoinTable(name: 'post')]
    private Collection $posts;

    public function getIdentifier(): int
    {
        return $this->identifier;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function setPosts(Collection $posts): void
    {
        $this->posts = $posts;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
