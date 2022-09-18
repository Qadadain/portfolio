<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BlogController extends AbstractController
{
    public const ROUTE_NAME_BLOG = 'blog';
    private const ROUTE_PATH_BLOG = '/blog';
    private const TEMPLATE = 'blog/blog.html.twig';

    public function __construct(
        private readonly Environment $renderer,
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route(path: self::ROUTE_PATH_BLOG, name: self::ROUTE_NAME_BLOG, methods: [HttpFoundation\Request::METHOD_GET])]
    public function handle(PaginatorInterface $paginator, Request $request): HttpFoundation\Response
    {
        $posts = $this->em->getRepository(Post::class)->findAll();
        $tags = $this->em->getRepository(Tag::class)->findAll();
        $posts = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            9,
        );

        return new HttpFoundation\Response(content: $this->renderer->render(name: self::TEMPLATE, context: [
            'posts' => $posts,
            'tags' => $tags,
        ]));
    }
}
