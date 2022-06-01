<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class BlogController extends AbstractController
{
    public const ROUTE_NAME_BLOG = 'blog';
    private const ROUTE_PATH_BLOG = '/blog';
    private const TEMPLATE = 'blog/blog.html.twig';

    public function __construct(
        private readonly Environment $renderer,
        private readonly EntityManagerInterface $em
    ) {
    }


    #[Route(path: self::ROUTE_PATH_BLOG, name: self::ROUTE_NAME_BLOG)]
    public function handle(): HttpFoundation\Response
    {
        $posts = $this->em->getRepository(entityName: Post::class)->findAll();

        return new HttpFoundation\Response(content: $this->renderer->render(name: self::TEMPLATE, context: [
            'posts' => $posts,
        ]));
    }
}