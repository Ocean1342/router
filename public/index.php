<?php
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use Ocean\Router\RouterContainer;
use Symfony\Component\ErrorHandler\Debug;

Debug::enable();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);


$f = function () {
    return 'hello route';
};

$routerContainer = new RouterContainer();
dump($routerContainer);

$map = $routerContainer->getMap();
$map->addRoute('test',
    '/test',
    $f,
    ['var1' => 'val1'],
    'GET'
);