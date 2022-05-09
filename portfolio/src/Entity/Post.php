<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Uid\Ulid;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $identifier;

    #[ORM\Column(type: Types::STRING, length: 180)]
    private string $title;

    #[ORM\Column(type: Types::STRING, length: 180)]
    private string $description;

    #[ORM\Column(type: Types::TEXT)]
    private string $content;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $createAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updateAt;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[JoinColumn(name: 'user_identifier', referencedColumnName: 'identifier')]
    private ?User $author;

    #[ORM\ManyToOne(targetEntity: Technology::class)]
    #[JoinColumn(name: 'technology_identifier', referencedColumnName: 'identifier')]
    private ?Technology $technology;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $slug;

    public function getIdentifier(): int
    {
        return $this->identifier;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreateAt(): \DateTimeInterface
    {
        return $this->createAt;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function getTechnology(): ?Technology
    {
        return $this->technology;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }



    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setCreateAt(\DateTimeInterface $createAt): void
    {
        $this->createAt = $createAt;
    }

    public function setUpdateAt(?\DateTimeInterface $updateAt): void
    {
        $this->updateAt = $updateAt;
    }

    public function setAuthor(?User $author): void
    {
        $this->author = $author;
    }

    public function setTechnology(?Technology $technology): void
    {
        $this->technology = $technology;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }


}