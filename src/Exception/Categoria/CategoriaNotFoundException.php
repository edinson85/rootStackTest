<?php

declare(strict_types=1);

namespace App\Exception\Categoria;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriaNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'Categoria con nombre %s no encontrada';

    public static function fromNombre(string $nombre): self
    {
        throw new self(\sprintf(self::MESSAGE, $nombre));
    }    

    public static function fromCategoriaId(string $id): self
    {
        throw new self(\sprintf('Categoria con id %s no encontrada', $id));
    }

    public static function fromCategoriaIdPage(string $id): self
    {
        throw new self(\sprintf('Categoria con id page %s no encontrada', $id));
    }
}
