<?php

ini_set('display_errors', 0);
error_reporting(E_WARNING);

require __DIR__.'../../vendor/autoload.php';

use Laminas\Diactoros\Request;
use Ocean\Router\Matcher;
use Ocean\Router\HttpMethods;
use Ocean\Router\RouteCollection;
use Symfony\Component\ErrorHandler\Debug;


Debug::enable();

$collection1 = new RouteCollection();


$request = new Request('/fall/123/asd',);

$f = function ($param1, $id, $tail) {
    /*    dump($param1);
        dump($id);
        dump($tail);*/
    return 'hello route';
};

$routeCollection = new RouteCollection();
$matcher = new Matcher();

$routeCollection->addRoute(
    'user',
    '/test',
    function () {
        /*        dump($id);
                dump($tail);*/
        return 'hello route';
    },
    [],
    HttpMethods::GET
);

$routeCollection->addRoute(
    'test'.rand(10, 99),
    '/fall/{id}/{tail}',
    function ($id, $tail) {
        dump($id);
        dump($tail);
        return 'hello route';
    },
    [],
    HttpMethods::GET
);

try {
    $matchedRoute = $matcher->match($request, $routeCollection);
//    call_user_func_array($matchedRoute->getHandler(), $matchedRoute->getParameters());
} catch (Exception $e) {
    dump($e->getMessage());
}


//есть совпадение роута, нет роута
if (isset($matchedRoute)) {
    dump('Route matched');
    //dump($matchedRoute->getPathRegex());
    //dump($matchedRoute->getHandler());
}


//нужно вызвать каллбек совпавшего роута