<?php

declare(strict_types=1);

namespace App\Exception;

final class PostNotFound extends PostError
{
    public function __construct(\Throwable $previous = null)
    {
        parent::__construct(message: 'Post not found', code: 404, previous: $previous);
    }
}
