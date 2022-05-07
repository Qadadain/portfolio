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
    #[Id]
    #[Column(type: 'ulid', unique: true)]
    #[GeneratedValue(strategy: 'NONE')]
    private Ulid $identifier;

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
    private Technology $technology;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $slug;
}