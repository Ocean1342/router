<?php

namespace Ocean\Router;


use ArrayIterator;
use Generator;
use IteratorAggregate;
use Ocean\Router\Interfaces\MethodsInterface;
use Ocean\Router\Interfaces\RouteCollectionInterface;
use Ocean\Router\Interfaces\RouteInterface;
use Traversable;

/**
 * @template-implements IteratorAggregate<Route>
 *
 */
class RouteCollection implements RouteCollectionInterface, IteratorAggregate
{
    /**
     * @var array<Route>
     */
    protected array $routeList = [];

    /**
     * @param  string  $name
     * @param  string  $path
     * @param $handler
     * @param  array  $parameters
     * @param  MethodsInterface  $method
     * @return void
     */
    public function addRoute(
        string $name,
        string $path,
        $handler,
        array $parameters,
        MethodsInterface $method

    ): void {
        $route = new Route(
            $name,
            $path,
            $handler,
            $parameters,
            $method
        );
        $this->routeList[] = $route;
    }

    public function get(string $path, $handler, $parameters = [], $name = ''): void
    {
        $this->addRoute(
            $name,
            $path,
            $handler,
            $parameters,
            HttpMethods::GET
        );
    }

    public function post(string $path, $handler, $parameters = [], $name = ''): void
    {
        $this->addRoute(
            $name,
            $path,
            $handler,
            $parameters,
            HttpMethods::POST
        );
    }

    public function put(string $path, $handler, $parameters = [], $name = ''): void
    {
        $this->addRoute(
            $name,
            $path,
            $handler,
            $parameters,
            HttpMethods::PUT
        );
    }

    public function delete(string $path, $handler, $parameters = [], $name = ''): void
    {
        $this->addRoute(
            $name,
            $path,
            $handler,
            $parameters,
            HttpMethods::DELETE
        );
    }

    /**
     * @return Generator<Route>
     */
    public function getRouteList(): iterable
    {
        foreach ($this->routeList as $route) {
            yield $route;
        }
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->routeList);
    }


    public function count(): int
    {
        return count($this->routeList);
    }

}