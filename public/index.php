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


$routerContainer->getMap()->addRoute('test',
        '/test',
        $f,
        ['var1' => 'val1'],
        'GET'
    );

$routerContainer->getMap()->addRoute('user',
    '/user/{id}',
    $f,
    ['var1' => 'val2'],
    'GET'
);

$matchedRoute = $routerContainer->getMatcher()->match($request,$routerContainer->getMap());

//есть совпадение роута, нет роута
if ($matchedRoute) {
    dump('еСТЬ СОВПАДЕНИЕ');
    dump($matchedRoute->getRegex());
    dump($matchedRoute->getHandler());
}


//нужно вызвать каллбек совпавшего роута