<?php
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use Ocean\Router\Matcher;
use Ocean\Router\RouteMap;
use Symfony\Component\ErrorHandler\Debug;


Debug::enable();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);


$f = function ($param1, $id, $tail) {
    dump($param1);
    dump($id);
    dump($tail);
    return 'hello route';
};

$map = new RouteMap();
$matcher = new Matcher();
/*$routerContainer->getMap()->addRoute('test',
        '/test',
        $f,
        ['var1' => 'val1'],
        'GET'
    );*/

$map->addRoute('user',
    '/test/{id}/{tail}',
    $f,
    [],
    'GET'
);

try {
    $matchedRoute = $matcher->match($request, $map);
    call_user_func_array($matchedRoute->getHandler(), $matchedRoute->getParameters());
} catch (Exception $e) {
    dump($e->getMessage());
}


//есть совпадение роута, нет роута
if (isset($matchedRoute)) {
    dump('Route matched');
    dump($matchedRoute->getPathRegex());
    dump($matchedRoute->getHandler());
}


//нужно вызвать каллбек совпавшего роута