<?php

require __DIR__.'../../vendor/autoload.php';

use Laminas\Diactoros\Request;
use Ocean\Router\Matcher;
use Ocean\Router\RouteCollection;
use Symfony\Component\ErrorHandler\Debug;

Debug::enable();

$request = new Request('/test/99/word', 'GET');

$routeCollection = new RouteCollection();
$matcher = new Matcher();

$routeCollection->get(
    '/test/{id}/{tail}',
    function (...$args) {
        dump('Route matched');
        return 'hello route';
    },
    ['param1' => 'value'],
);

$routeCollection->post(
    '/fall/{id}/{tail}',
    function ($id, $tail) {
        dump($id);
        dump($tail);
        return 'hello route';
    },
    [],
);

try {
    $matchedRoute = $matcher->match($request, $routeCollection);
    call_user_func_array(
        $matchedRoute->getRoute()->getHandler(),
        $matchedRoute->getRoute()->getParameters()
    );
} catch (Exception $e) {
    dump($e->getMessage());
}

