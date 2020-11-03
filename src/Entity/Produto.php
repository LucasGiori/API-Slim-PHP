<?php

declare(strict_types=1);

namespace Alfa\Entity;

use DateTime;

class Produto
{
    protected int $id;
    protected string $descricao;
    protected float $valor;
    protected DateTime $data_inclusao; 

    public function __construct(){}

    public function getId() :int
    {
        return $this->id;
    }
    public function setId(int $id) :void
    {
        $this->id = $id;
    }

    public function getDescricao() :string
    {
        return $this->descricao;
    }
    public function setDescricao(string $descricao) :void
    {
        $this->descricao = $descricao;
    }

    public function getValor() :float
    {
        return $this->valor;
    }
    public function setValor(float $valor) :void
    {
        $this->valor = $valor;
    }

    public function getDataInclusao() :DateTime
    {
        return $this->data_inclusao;
    }
    public function setDataInclusao(DateTime $data_inclusao) :void
    {
        $this->data_inclusao = $data_inclusao;
    }
}