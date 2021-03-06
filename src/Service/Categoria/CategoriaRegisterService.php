<?php

declare(strict_types=1);

namespace App\Service\Categoria;

use App\Entity\Categoria;
use App\Exception\Categoria\CategoriaAlreadyExistException;
use App\Repository\CategoriaRepository;


class CategoriaRegisterService
{
    private CategoriaRepository $categoriaRepository;    

    public function __construct(
        CategoriaRepository $categoriaRepository
    ) {
        $this->categoriaRepository = $categoriaRepository;        
    }

    public function create(string $name, string $path): Categoria
    {
        $categoria = new Categoria($name, $path);        
        
        try {
            $this->categoriaRepository->save($categoria);
        } catch (\Exception $exception) {
            throw CategoriaAlreadyExistException::fromName($name);
        }        

        return $categoria;
    }
}
