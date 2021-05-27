<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$pieces = ["myapp"];
$piecesQty = count($pieces);

$vap = str_repeat("/.." , $piecesQty);
require __DIR__ . $vap . '/vendor/autoload.php';

define('BASEPATH',"/" . implode("/",$pieces));
$app = AppFactory::create();
$app->setBasePath(BASEPATH);

$app->get('/', function (Request $request, Response $response, $args) {
	    $ohh = "Hello world! >> " . BASEPATH;
	    $response->getBody()->write($ohh);
	    return $response;
});

$app->run();
