<?php

namespace Ocean\Router;


use ArrayIterator;
use Generator;
use IteratorAggregate;
use Ocean\Router\Interfaces\MethodsInterface;
use Ocean\Router\Interfaces\RouteCollectionInterface;
use Traversable;

/**
 * @template-implements IteratorAggregate<Route>
 *
 */
class RouteCollection implements RouteCollectionInterface, IteratorAggregate
{
    /**
     * @var array
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
    
    /**
     * @return Generator<int, mixed, mixed, void>
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