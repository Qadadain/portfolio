<?php

namespace App\Controller;

use App\Exception\PostNotFound;
use App\Factory\PostUrlRedirection;
use App\Repository\GetPostsBySlug;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PostController implements Action
{
    public const ROUTE_NAME_BLOG = 'post';
    private const ROUTE_PATH_BLOG = 'blog/{slug}/';
    private const TEMPLATE = 'blog/post.html.twig';

    public function __construct(
        private readonly Environment $renderer,
        private readonly GetPostsBySlug $postsBySlug,
        private readonly PostUrlRedirection $postUrlRedirection,
    ) {
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws NonUniqueResultException
     * @throws LoaderError
     */
    #[Route(path: self::ROUTE_PATH_BLOG, name: self::ROUTE_NAME_BLOG)]
    public function handle(HttpFoundation\Request $request): HttpFoundation\Response
    {
        $slug = $request->attributes->get(key: 'slug');

        $post = $this->postsBySlug->getPostBySlug($slug);
        if (null === $post) {
            throw new PostNotFound();
        }

        if (basename($request->getUri()) !== $post->getSlug()){
            return new HttpFoundation\RedirectResponse($this->postUrlRedirection->urlConstructor($request), 301);
        }

        return new HttpFoundation\Response(content: $this->renderer->render(name: self::TEMPLATE, context: [
            'post' => $post,
        ]));
    }
}
