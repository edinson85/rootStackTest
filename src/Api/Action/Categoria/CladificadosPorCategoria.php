<?php

declare(strict_types=1);

namespace App\Api\Action\Categoria;

use App\Entity\Categoria;
use App\Service\Request\RequestService;
use App\Service\Categoria\ClasificadosPorCategoriaService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CladificadosPorCategoria
{
    private ClasificadosPorCategoriaService $clasificadosPorCategoriaService;

    public function __construct(ClasificadosPorCategoriaService $clasificadosPorCategoriaService)
    {
        $this->clasificadosPorCategoriaService = $clasificadosPorCategoriaService;
    }

    public function __invoke(Request $request): JsonResponse
    {        
        $respuesta = $this->clasificadosPorCategoriaService->buscar(            
            RequestService::getField($request, 'idCategoria')
        );
        return new JsonResponse($respuesta);            
    }
}
