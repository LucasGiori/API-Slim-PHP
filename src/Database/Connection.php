<?php 

declare(strict_types=1);

namespace Alfa\Database;

use PDO;
use Alfa\Database\Statement;

class Connection extends PDO 
{
    protected $banco;
    protected $usuario;
    protected $senha;
    protected $host;

    public function __construct()
    {
        $this->banco = $_ENV["DATABASE_NAME"];
        $this->usuario = $_ENV["DATABASE_USER"];
        $this->senha = $_ENV["DATABASE_PASSWORD"];
        $this->host = $_ENV["DATABASE_HOST"];
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_STATEMENT_CLASS => array(Statement::class)
        );
        parent::__construct("mysql:host={$this->host};dbname={$this->banco}",$this->usuario,$this->senha,$options);
    }

}