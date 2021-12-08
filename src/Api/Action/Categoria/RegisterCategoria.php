<?php

declare(strict_types=1);

namespace App\Api\Action\Categoria;

use App\Entity\Categoria;
use App\Service\Request\RequestService;
use App\Service\Categoria\CategoriaRegisterService;
use Symfony\Component\HttpFoundation\Request;

class RegisterCategoria
{
    private CategoriaRegisterService $categoriaRegisterService;

    public function __construct(CategoriaRegisterService $categoriaRegisterService)
    {
        $this->categoriaRegisterService = $categoriaRegisterService;
    }

    public function __invoke(Request $request): Categoria
    {
        return $this->categoriaRegisterService->create(
            RequestService::getField($request, 'name'),            
            RequestService::getField($request, 'path')
        );
    }
}
