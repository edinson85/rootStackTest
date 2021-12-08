<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Categoria;
use App\Exception\Categoria\CategoriaNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class CategoriaRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Categoria::class;
    }

    public function findOneById(string $id): Categoria
    {
        if (null === $categoria = $this->objectRepository->find($id)) {
            throw CategoriaNotFoundException::fromCategoriaId($id);
        }

        return $categoria;
    }

    public function findOneByIdPageOrFail(string $idPage): Categoria
    {
        if (null === $categoria = $this->objectRepository->findOneBy(['idPage' => $idPage])) {
            throw CategoriaNotFoundException::fromCategoriaId($idPage);
        }

        return $categoria;
    }

    public function findOneByNombreOrFail(string $nombre): Categoria
    {
        if (null === $categoria = $this->objectRepository->findOneBy(['nombre' => $nombre])) {
            throw CategoriaNotFoundException::fromNombre($nombre);
        }

        return $categoria;
    }
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Categoria $categoria): void
    {
        $this->saveEntity($categoria);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Categoria $categoria): void
    {
        $this->removeEntity($categoria);
    }
}
