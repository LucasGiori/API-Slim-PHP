<?php

declare(strict_types=1);

use Alfa\Controller\ProdutoController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

$app->group('/produtos', function (RouteCollectorProxy $group) {

    $group->post('[/]', function (Request $request,Response $response,$args){        
        return (new ProdutoController($request,$response,$args))->save();         
    });
    
});
