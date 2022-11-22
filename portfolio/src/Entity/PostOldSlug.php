<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
class PostOldSlug
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'ulid', unique: true)]
    private Ulid $identifier;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $oldSlug;

    #[ORM\ManyToOne(targetEntity: Post::class, cascade: ['persist'], inversedBy: 'oldSlug')]
    #[JoinColumn(name: 'post_blog_identifier', referencedColumnName: 'identifier')]
    private ?Post $post;

    public function getIdentifier(): Ulid
    {
        return $this->identifier;
    }

    public function setIdentifier(Ulid $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getOldSlug(): string
    {
        return $this->oldSlug;
    }

    public function setOldSlug(string $oldSlug): self
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
