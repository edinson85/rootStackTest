<?php

declare(strict_types=1);

namespace App\Exception\Categoria;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class CategoriaAlreadyExistException extends ConflictHttpException
{
    private const MESSAGE = 'Categoria con nombre %s ya existe';

    public static function fromName(string $nombre): self
    {
        throw new self(\sprintf(self::MESSAGE, $nombre));
    }
}
