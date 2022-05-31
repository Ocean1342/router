<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\RouteMapInterface;

class RouteMap implements RouteMapInterface
{
    protected array $routeList;

    public function addRoute(
        string $name,
        string $rawPath,
        $handler,
        array  $parameters,
        string $method

    ): void
    {
        $route = new Route(
            $name,
            $rawPath,
            $handler,
            $parameters,
            $method
        );
        $this->routeList[] = $route;
    }


    public function getRouteList(): array
    {
        return $this->routeList;
    }
}