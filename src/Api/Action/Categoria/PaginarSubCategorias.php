<?php

declare(strict_types=1);

namespace App\Api\Action\Categoria;

use App\Entity\Categoria;
use App\Service\Request\RequestService;
use App\Service\Categoria\PaginarSubCategoriasService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PaginarSubCategorias
{
    private PaginarSubCategoriasService $paginarSubCategoriasService;

    public function __construct(PaginarSubCategoriasService $paginarSubCategoriasService)
    {
        $this->paginarSubCategoriasService = $paginarSubCategoriasService;
    }

    public function __invoke(Request $request): JsonResponse
    {        
        $respuesta = $this->paginarSubCategoriasService->listar(
            RequestService::getField($request, 'idPadre'),
            RequestService::getField($request, 'pagina'),
            RequestService::getField($request, 'tam')
        );        
        return new JsonResponse($respuesta);            
    }
}
