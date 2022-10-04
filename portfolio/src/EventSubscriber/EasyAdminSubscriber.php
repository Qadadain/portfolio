<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Post;
use App\Entity\PostOldSlug;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setOldSlugsOnPersistedEvent'],
            BeforeEntityUpdatedEvent::class => ['setOldSlugsOnUpdatedEvent'],
        ];
    }

    /**
     * @throws Exception
     */
    public function setOldSlugsOnPersistedEvent(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Post)) {
            return;
        }
        $oldSlug = new PostOldSlug();
        $oldSlug->setOldSlug($entity->getSlug())
            ->setPost($entity);
        $this->entityManager->persist($oldSlug);
        $this->entityManager->flush();
    }

    /**
     * @throws Exception
     */
    public function setOldSlugsOnUpdatedEvent(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Post)) {
            return;
        }

        $oldSlugs = $entity->getOldSlug()->toArray();
        foreach ($oldSlugs as $data) {
            if ($data->getOldSlug() === $entity->getSlug()) {
                return;
            }
        }
        $oldSlug = new PostOldSlug();
        $oldSlug->setOldSlug($entity->getSlug())
            ->setPost($entity);
        $this->entityManager->persist($oldSlug);
        $this->entityManager->flush();
    }
}
