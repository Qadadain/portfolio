<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

final class PostNotFound extends RuntimeException
{
    public function __construct(\Throwable $previous = null)
    {
        parent::__construct(message: 'Post not found', code: 404, previous: $previous);
    }
}
