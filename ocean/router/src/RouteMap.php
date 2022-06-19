<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\RouteMapInterface;

/**
 *
 */
class RouteMap implements RouteMapInterface
{
    /**
     * @var array
     */
    protected array $routeList;

    /**
     * @param string $name
     * @param string $path
     * @param $handler
     * @param array $parameters
     * @param string $method
     * @return void
     */
    public function addRoute(
        string $name,
        string $path,
               $handler,
        array  $parameters,
        string $method

    ): void
    {
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
     * @return array|Interfaces\RouteInterface[]
     */
    public function getRouteList(): array
    {
        return $this->routeList;
    }
}