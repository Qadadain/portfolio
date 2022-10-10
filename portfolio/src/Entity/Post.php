<?php

namespace App\Entity;

use DateTimeZone;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'blog_post')]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private string $title;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $slug;

    #[ORM\Column(type: 'string')]
    #[Assert\Length(max: 255)]
    private ?string $description = null;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $publishedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $updatedAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'posts')]
    #[JoinColumn(name: 'user_identifier', referencedColumnName: 'identifier')]
    private ?User $author;

    /**
     * @var Tag[]|Collection
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, cascade: ['persist'])]
    #[ORM\JoinTable(name: 'post_tag')]
    #[ORM\OrderBy(['name' => 'ASC'])]
    private Collection $tags;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: PostOldSlug::class)]
    private Collection $oldSlug;

    public function __construct()
    {
        $this->publishedAt = new \DateTime();
        $this->tags = new ArrayCollection();
        $this->oldSlug = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setAuthor(?User $author): void
    {
        $this->author = $author;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function getPublishedAt(): \DateTime
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTime $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @throws \Exception
     */
    #[ORM\PreUpdate]
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime(datetime: 'now', timezone: new DateTimeZone(timezone: 'Europe/Paris'));

        return $this;
    }

    public function addTag(Tag ...$tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }
    }

    public function removeTag(Tag $tag): void
    {
        $this->tags->removeElement($tag);
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @return Collection<int, PostOldSlug>
     */
    public function getOldSlug(): Collection
    {
        return $this->oldSlug;
    }

    public function addOldSlug(PostOldSlug $oldSlug): self
    {
        if (!$this->oldSlug->contains($oldSlug)) {
            $this->oldSlug[] = $oldSlug;
            $oldSlug->setPost($this);
        }

        return $this;
    }

    public function removeOldSlug(PostOldSlug $oldSlug): self
    {
        if ($this->oldSlug->removeElement($oldSlug)) {
            // set the owning side to null (unless already changed)
            if ($oldSlug->getPost() === $this) {
                $oldSlug->setPost(post: null);
            }
        }

        return $this;
    }
}
