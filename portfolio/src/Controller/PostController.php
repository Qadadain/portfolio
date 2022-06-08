<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PostController extends AbstractController
{
    public const ROUTE_NAME_BLOG = 'post';
    private const ROUTE_PATH_BLOG = 'blog/{slug}';
    private const TEMPLATE = 'blog/post.html.twig';

    public function __construct(
        private readonly Environment $renderer,
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route(path: self::ROUTE_PATH_BLOG, name: self::ROUTE_NAME_BLOG)]
    public function handle(HttpFoundation\Request $request): HttpFoundation\Response
    {
        $slug = $request->attributes->get(key: 'slug');

        $post = $this->em->getRepository(entityName: Post::class)->findOneBy(criteria: ['slug' => $slug]);

        return new HttpFoundation\Response(content: $this->renderer->render(name: self::TEMPLATE, context: [
            'post' => $post,
        ]));
    }
}
