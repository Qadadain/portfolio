<?php

declare(strict_types=1);

namespace App\Exception;

final class MultiplePostsFound extends PostError
{
    public function __construct(\Throwable $previous = null)
    {
        parent::__construct(message: 'Multiple post found', code: 500, previous: $previous);
    }
}
