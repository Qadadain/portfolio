<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PostOldSlug
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $oldSlug;

    #[ORM\ManyToOne(targetEntity: Post::class, cascade: ['persist'], inversedBy: 'oldSlug')]
    private $post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOldSlug(): ?string
    {
        return $this->oldSlug;
    }

    public function setOldSlug(?string $oldSlug): self
    {
        $this->oldSlug = $oldSlug;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}