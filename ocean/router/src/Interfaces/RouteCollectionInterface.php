<?php

namespace Ocean\Router\Interfaces;


interface RouteCollectionInterface extends \Traversable, \Countable
{
    public function addRoute(string $name, string $path, $handler, array $parameters, MethodsInterface $method): void;

    /**
     *
     * @return RouteInterface[]
     */
    public function getRouteList(): iterable;
}