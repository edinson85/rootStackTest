<?php

declare(strict_types=1);

namespace App\Service\Categoria;

use App\Entity\Categoria;
use App\Exception\Categoria\CategoriaAlreadyExistException;
use App\Repository\CategoriaRepository;


class SubCategoriaRegisterService
{
    private CategoriaRepository $categoriaRepository;    

    public function __construct(
        CategoriaRepository $categoriaRepository
    ) {
        $this->categoriaRepository = $categoriaRepository;        
    }

    public function create(string $name, string $path,string $idPadre): Categoria
    {        
        $categoria = new Categoria($name, $path);          
        $padre = $this->categoriaRepository->findOneById($idPadre);
        $categoria->setPadre($padre);
        try{
            $this->categoriaRepository->save($categoria);        
        } catch (\Exception $exception) {
            throw CategoriaAlreadyExistException::fromName($name);
        }          
        return $categoria;
    }
}
