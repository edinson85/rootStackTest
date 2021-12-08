<?php

declare(strict_types=1);

namespace App\Api\Action\Categoria;

use App\Entity\Categoria;
use App\Service\Request\RequestService;
use App\Service\Categoria\SubCategoriaRegisterService;
use Symfony\Component\HttpFoundation\Request;

class RegisterSubCategoria
{
    private SubCategoriaRegisterService $subCategoriaRegisterService;

    public function __construct(SubCategoriaRegisterService $subCategoriaRegisterService)
    {
        $this->subCategoriaRegisterService = $subCategoriaRegisterService;
    }

    public function __invoke(Request $request): Categoria
    {
        //dump("Edinson");
        //die;
        return $this->subCategoriaRegisterService->create(
            RequestService::getField($request, 'name'),            
            RequestService::getField($request, 'path'),
            RequestService::getField($request, 'idPadre')
        );
    }
}
