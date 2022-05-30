<?php

namespace Ocean\Router;

class RouteMap
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