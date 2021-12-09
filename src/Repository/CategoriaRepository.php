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
        if (null === $categoria = $this->objectRepository->findOneBy(['name' => $nombre])) {
            throw CategoriaNotFoundException::fromNombre($nombre);
        }

        return $categoria;
    }
    public function findOneByNombre(string $nombre): ?Categoria
    {   
        $respuesta = $this->objectRepository->findOneBy(['name' => $nombre]);        
        return $this->objectRepository->findOneBy(['name' => $nombre]);                    
    }
    public function findAllCategorias(): ?array
    {   
        $respuesta = $this->objectRepository->findBy(['padre' => null]);        
        return $respuesta;
    }
    public function paginarCategorias($pagina, $tam): ?array
    {           
        $inicio = ($pagina - 1) * $tam;
        $conn = $this->getEntityManager()->getConnection();
        $comando = " select * from categoria where padre_id is null order by name limit $tam offset $inicio ";
        $stmt = $conn->query($comando);
        $stmt->execute();        
        $resultados = $stmt->fetchAll();
        return $resultados;
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
