<?php

declare(strict_types = 1);

namespace Alfa\Service;

use Alfa\InterfaceRepository\InterfaceProduto;

class ProdutoService
{
    private InterfaceProduto $interfaceProduto;

    public function __construct(InterfaceProduto $interfaceProduto)
    {
        $this->interfaceProduto = $interfaceProduto;
    }

    public function save(object $request):int
    {
        return $this->interfaceProduto->save($request);
    }
}