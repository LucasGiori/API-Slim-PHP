<?php

declare(strict_types = 1);

namespace Alfa\Repository;

use Alfa\Database\Connection;
use Alfa\InterfaceRepository\InterfaceProduto;
use Alfa\Database\Exception\CheckViolatedConstraint;
use Alfa\Database\Exception\UniqueViolatedConstraint;

use Exception;

class ProdutoRepository implements InterfaceProduto
{
    private Connection $dbh;

    public function __construct(Connection $dbh)
    {
        $this->dbh = $dbh;
    }

    public function save(object $request) :int
    {   
        
        try{
            $this->dbh->beginTransaction();
            $sql = "INSERT INTO produto (descricao,valor) VALUES (:descricao,:valor); ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':descricao',$request->descricao);
            $stmt->bindParam(':valor',$request->valor);            
            $stmt->execute();
            $id =  $this->dbh->lastInsertId();   
            $this->dbh->commit(); 
            return (int)$id;
        }catch(CheckViolatedConstraint $e){
            $this->dbh->rollBack(); 
            throw new Exception('Verificação Check  Violada, o Valor do produto deve ser maior que 5!!!');
        }catch(UniqueViolatedConstraint $e){
            $this->dbh->rollBack(); 
            throw new Exception('Verificação Unique Violada, o produto com essa descrição já existe');
        }catch(Exception $e){
            $this->dbh->rollBack(); 
            throw new Exception("Error: ".$e->getMessage());
        }
    }
}