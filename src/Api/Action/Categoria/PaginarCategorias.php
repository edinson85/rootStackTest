<?php

declare(strict_types=1);

namespace App\Api\Action\Categoria;

use App\Entity\Categoria;
use App\Service\Request\RequestService;
use App\Service\Categoria\PaginarCategoriasService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PaginarCategorias
{
    private PaginarCategoriasService $paginarCategoriasService;

    public function __construct(PaginarCategoriasService $paginarCategoriasService)
    {
        $this->paginarCategoriasService = $paginarCategoriasService;
    }

    public function __invoke(Request $request): JsonResponse
    {        
        $respuesta = $this->paginarCategoriasService->listar(
            RequestService::getField($request, 'pagina'),
            RequestService::getField($request, 'tam')
        );        
        return new JsonResponse($respuesta);            
    }
}
