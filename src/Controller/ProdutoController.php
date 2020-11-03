<?php

declare(strict_types=1);
namespace Alfa\Controller;

use Exception;
use Alfa\Entity\Produto;
use Alfa\App\ValidateEntity;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Alfa\Repository\ProdutoRepository;
use Alfa\Service\ProdutoService;
use Alfa\Database\Connection;
use ReflectionClass;


class ProdutoController
{
    protected Request $request;
    protected Response $response;
    protected $args;

    public function __construct(Request $request, Response $response,$args)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->args = $args;
    }

    public function save()
    {   

        try{      
            $produto = json_decode($this->request->getBody()->getContents());

            $validate = new ValidateEntity((new ReflectionClass(Produto::class)),(array)$produto,['id','data_inclusao']);
            $required_validate = $validate->validateParamRequiredExists();

            if($required_validate['message'] != ''){
                $this->response->getBody()->write(json_encode($required_validate));
                return $this->response->withHeader('Content-Type','application/json')->withStatus(500);
            }

            $produtoRepository = new ProdutoRepository(new Connection());
            $produtoService = new ProdutoService($produtoRepository);
            $id = $produtoService->save($produto);      

            $this->response->getBody()->write(json_encode(["message"=>"Produto Cadastrado Com Sucesso!!!",'id'=>$id]));
            return $this->response->withHeader('Content-Type','application/json')->withStatus(201);

        }catch(Exception $e){
            $this->response->getBody()->write(json_encode(["message"=>"Produto Não Cadastrado!!!",'error'=>$e->getMessage()]));
            return $this->response->withHeader('Content-Type','application/json')->withStatus(500);
        }
        
    }
}