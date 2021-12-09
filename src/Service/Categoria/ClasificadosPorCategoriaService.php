<?php

declare(strict_types=1);

namespace App\Service\Categoria;

use App\Entity\Categoria;
use App\Exception\Categoria\CategoriaNotFoundException;
use App\Repository\CategoriaRepository;
use App\Service\Utiles\UtilesScraper;


class ClasificadosPorCategoriaService
{
    private CategoriaRepository $categoriaRepository;    

    public function __construct(
        CategoriaRepository $categoriaRepository
    ) {
        $this->categoriaRepository = $categoriaRepository;        
    }

    public function buscar(string $idCategoria): ?string
    {                
        $categoria = $this->categoriaRepository->findOneById($idCategoria);
        if(is_null($categoria)){
            throw CategoriaNotFoundException::fromCategoriaId($idCategoria);
        }
        $retorno = UtilesScraper::curlWeb(UtilesScraper::URL_PRINCIPAL.$categoria->getPath(),true);
        return $retorno;
    }
}
