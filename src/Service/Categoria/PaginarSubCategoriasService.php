<?php

declare(strict_types=1);

namespace App\Service\Categoria;

use App\Entity\Categoria;
use App\Exception\Categoria\CategoriaAlreadyExistException;
use App\Repository\CategoriaRepository;


class PaginarSubCategoriasService
{
    const TAM_2 = "2";
    const TAM_4 = "4";
    private CategoriaRepository $categoriaRepository;    

    public function __construct(
        CategoriaRepository $categoriaRepository
    ) {
        $this->categoriaRepository = $categoriaRepository;        
    }

    public function listar(string $idPadre,string $page, string $tamIngresa = "4"): ?array
    {   
        $tam = 4;   
        if (strcmp($tamIngresa, self::TAM_2) === 0) {
            $tam = 2;
        }
        if (strcmp($tamIngresa, self::TAM_4) === 0) {
            $tam = 4;
        }        
        $page = (int)$page;        
        return $this->categoriaRepository->paginarSubCategorias($idPadre,$page,$tam);                        
    }
}
