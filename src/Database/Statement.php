<?php 

declare(strict_types=1);


namespace Alfa\Database;

use PDOException;
use PDOStatement;
use Alfa\Database\Exception\CheckViolatedConstraint;
use Alfa\Database\Exception\SintaxeErrorException;
use Alfa\Database\Exception\TabelaInexistenteException;
use Alfa\Database\Exception\UniqueViolatedConstraint;

class Statement extends PDOStatement
{
    public function execute($input_parameters = null)
    {
        try{
            parent::execute($input_parameters);
        }catch(PDOException $e){
            switch ($e->errorInfo[1]){
                case '1146':
                    throw new TabelaInexistenteException($e->getMessage());
                    break;
                case '1064':
                    throw new SintaxeErrorException($e->getMessage());
                    break;
                case '1062':
                    throw new UniqueViolatedConstraint($e->getMessage());
                    break;
                case '3819':
                    throw new CheckViolatedConstraint($e->getMessage());
                    break;                
                default:
                    throw $e;
                    break;
            }
        }
    }
}