<?php

date_default_timezone_set("Europe/Berlin");
setlocale (LC_ALL, 'de_DE');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require_once 'app/data/alb/AlbGetter.php';

$app = new \Slim\App;
$app->get('/', function (Request $request, Response $response, array $args) {
    $alb = new AlbGetter('app/data/alb/output.json');
    $alb->build();
    $response->withHeader('Content-Type', 'application/json');
    $response->getBody()->write($alb->get());
    return $response;
});
$app->run();

?>
