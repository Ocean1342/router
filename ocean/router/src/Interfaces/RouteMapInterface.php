<?php

namespace Ocean\Router\Interfaces;

interface RouteMapInterface
{
    public function addRoute(string $name, string $rawPath, $handler, array $parameters, string $method): void;

    /**
     *
     * @return RouteInterface[]
     */
    public function getRouteList(): array;
}