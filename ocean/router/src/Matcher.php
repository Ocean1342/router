<?php

namespace Ocean\Router;


use Ocean\Router\Interfaces\RouteMapInterface;
use Psr\Http\Message\RequestInterface;

class Matcher
{
    public function match(RequestInterface $request,RouteMapInterface $map)
    {

        foreach ($map->getRouteList() as $route) {

            // matching route and request uri
            if (preg_match($route->getRawPath(), $request->getUri()->getPath(), $matchesInUri)) {
                $routeFound = true;

                if ($request->getMethod() !== $route->getMethod()) {
                    continue;
                }
                $methodEqual = true;

                // add route vars to Route object
                unset($matchesInUri[0]);
                foreach ($matchesInUri as $k => $match) {
                    $route->setVarsValue(--$k, $match);
                }
                $currentRoute = $route;
            }
        }
        dump($currentRoute);
    }
}