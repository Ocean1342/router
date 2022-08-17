<?php

namespace Ocean\Router\Tests;

use Laminas\Diactoros\Request;
use Ocean\Router\Exceptions\BadMethodException;
use Ocean\Router\Exceptions\RouteNotFoundException;
use Ocean\Router\HttpMethods;
use Ocean\Router\Interfaces\MatchedRouteInterface;
use Ocean\Router\Interfaces\RouteInterface;
use Ocean\Router\Matcher;
use Ocean\Router\RouteCollection;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;


/**
 * @group matcherGroup
 */
class MatcherTest extends TestCase
{


    public function routeProvider()
    {
        return [
            ['/test', HttpMethods::POST, 'simple-route', '/test'],
            ['/test/ivan/99', HttpMethods::POST, 'dynamic-route', '/test/{user}/{id}'],
        ];
    }

    /**
     * @dataProvider routeProvider
     */
    public function testMatchRoute($uri, $method, $name, $path)
    {
        $request = new Request($uri, $method->name);
        $matchedRoute = $this->prepareMatchedRoute($request, $uri, $method, $name, $path);
        $this->assertSame($matchedRoute->getRoute()->getName(), $name);
    }

    /**
     * @dataProvider routeProvider
     */
    public function testRouteNotFoundException($uri, $method, $name, $path)
    {
        $this->expectException('Ocean\Router\Exceptions\RouteNotFoundException');
        $request = new Request($uri, $method->name);
        $this->prepareMatchedRoute($request, '/failed-route', $method, $name, '/');
    }

    /**
     * @dataProvider routeProvider
     */
    public function testRouteNotBadMethodException($uri, $method, $name, $path)
    {
        $this->expectException('Ocean\Router\Exceptions\BadMethodException');
        $request = new Request($uri, $method->name);
        $this->prepareMatchedRoute($request, $uri, HttpMethods::GET, $name, $path);
    }

    /**
     * @param $request RequestInterface
     * @param $uri
     * @param $method
     * @param $name
     * @param $path
     * @return RouteInterface
     * @throws BadMethodException
     * @throws RouteNotFoundException
     */
    public function prepareMatchedRoute($request, $uri, $method, $name, $path): MatchedRouteInterface
    {
        $map = new RouteCollection();
        $map->addRoute($name, $path, function () {
            //stub
        }, [], $method);
        $matcher = new Matcher();

        return $matcher->match($request, $map);
    }

}