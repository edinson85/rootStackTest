<?php

declare(strict_types=1);

namespace App\Exception\Categoria;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class CategoriaAlreadyExistException extends ConflictHttpException
{
    private const MESSAGE = 'Categoria con id page %s ya existe';

    public static function fromIdPage(string $nombre): self
    {
        throw new self(\sprintf(self::MESSAGE, $nombre));
    }
}
