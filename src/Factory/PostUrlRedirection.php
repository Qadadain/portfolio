<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\PostOldSlug;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class PostUrlRedirection
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function urlConstructor(Request $request): string
    {
        $goodSlug = $this->entityManager->getRepository(PostOldSlug::class)->findOneBy(['oldSlug' => basename($request->getUri())]);

        return dirname($request->getUri()).'/'.$goodSlug->getPost()->getSlug().'/';
    }
}
