<?php

declare(strict_types=1);

namespace App\Decorator;

use App\Controller\Action;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class PostBadSlug implements Action
{
    public function __construct(
        private readonly Action $innerAction,
        private readonly Environment $renderer,
    ) {
    }

    public function handle(Request $request): Response
    {
        try {
            return $this->innerAction->handle($request);
        } catch (\App\Exception\PostNotFound) {
            return new Response($this->renderer->render(name: 'errors/404.html.twig'), status: 404);
        }
    }
}
