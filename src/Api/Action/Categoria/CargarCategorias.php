<?php

declare(strict_types=1);

namespace App\Api\Action\Categoria;

use App\Entity\Categoria;
use App\Service\Request\RequestService;
use App\Service\Categoria\CargarCategoriasService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CargarCategorias
{
    private CargarCategoriasService $cargarCategoriasService;

    public function __construct(CargarCategoriasService $cargarCategoriasService)
    {
        $this->cargarCategoriasService = $cargarCategoriasService;
    }

    public function __invoke(Request $request): JsonResponse
    {             
        $respuesta = $this->cargarCategoriasService->cargarDatos();        
        return new JsonResponse($respuesta);            
    }
}
