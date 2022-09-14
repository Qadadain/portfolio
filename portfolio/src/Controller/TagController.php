<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Tag;
use App\Repository\GetPostsByTag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route(path: self::ROUTE_PATH_TAG, name: self::ROUTE_NAME_TAG)]
class TagController extends AbstractController
{
    public const ROUTE_NAME_TAG = 'tag_';
    private const ROUTE_PATH_TAG = '/tags';
    public const ROUTE_NAME_INDEX_TAG = 'index';
    private const ROUTE_PATH_INDEX_TAG = '/';
    public const ROUTE_NAME_SHOW_TAG = 'show';
    private const ROUTE_PATH_SHOW_TAG = '/{tagName}';
    private const TEMPLATE_INDEX_TAG = 'tag/index.html.twig';
    private const TEMPLATE_SHOW_TAG = 'tag/show.html.twig';

    public function __construct(
        private readonly Environment $renderer,
        private readonly EntityManagerInterface $em,
        private readonly GetPostsByTag $getPostsByTag,
    ) {
    }

#[Route(path: self::ROUTE_PATH_INDEX_TAG, name: self::ROUTE_NAME_INDEX_TAG, methods: [HttpFoundation\Request::METHOD_GET])]
    public function handle(): HttpFoundation\Response
    {
        $tags = $this->em->getRepository(entityName: Tag::class)->findAll();

        return new HttpFoundation\Response(content: $this->renderer->render(name: self::TEMPLATE_INDEX_TAG, context: [
            'tags' => $tags,
        ]));
    }

    #[Route(path: self::ROUTE_PATH_SHOW_TAG, name: self::ROUTE_NAME_SHOW_TAG, methods: [HttpFoundation\Request::METHOD_GET])]
    public function showTag(string $tagName): HttpFoundation\Response
    {
        $tag = $this->em->getRepository(entityName: Tag::class)->findBy(['name' => $tagName]);
        $tagPost = $this->getPostsByTag->postByTag($tag[0]->getId());
        $posts = $this->em->getRepository(entityName: Tag::class)->findBy(['id'=> $tagPost]);

        return new HttpFoundation\Response(content: $this->renderer->render(name: self::TEMPLATE_SHOW_TAG, context: [
            'tagPost' => $tagPost,
            'posts' => $posts,
        ]));
    }
}
