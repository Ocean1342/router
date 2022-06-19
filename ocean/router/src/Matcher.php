<?php

namespace Ocean\Router;


use Ocean\Router\Exceptions\BadMethodException;
use Ocean\Router\Exceptions\RouteNotFoundException;
use Ocean\Router\Interfaces\RouteInterface;
use Ocean\Router\Interfaces\RouteMapInterface;
use Psr\Http\Message\RequestInterface;

class Matcher
{
    /** @psalm-var RouteInterface matched route */
    protected RouteInterface $matchedRoute;

    /**
     * @param RequestInterface $request
     * @param RouteMapInterface $map
     *
     * @return RouteInterface
     *
     * @throws RouteNotFoundException|BadMethodException
     */
    public function match(RequestInterface $request, RouteMapInterface $map): RouteInterface
    {
        $routeFound = false;
        $methodEqual = false;
        foreach ($map->getRouteList() as $route) {

            if (preg_match($route->getPathRegex(), $request->getUri()->getPath(), $matchesInUri)) {
                $routeFound = true;

                if ($request->getMethod() !== $route->getMethod()) {
                    continue;
                }
                $methodEqual = true;

                // add route vars to Route object
                unset($matchesInUri[0]);
                foreach ($matchesInUri as $k => $match) {
                    $route->routeHelper->setVarValues(--$k, $match);
                }
                $currentRoute = $route;
                $currentRoute->mergeParametersAndRouteVars();

            }
        }

        if (!$routeFound) {
            throw new RouteNotFoundException('Not found route');
        }
        if (!$methodEqual) {
            throw new BadMethodException('Method in route not equal');
        }

        return $currentRoute;

    }
}