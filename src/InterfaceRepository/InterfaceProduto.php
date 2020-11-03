<?php

declare (strict_types=1);

namespace Alfa\InterfaceRepository;

use Alfa\Entity\Produto;

interface InterfaceProduto
{
    public function save(object $request) : int;
}