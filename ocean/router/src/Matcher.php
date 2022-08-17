<?php

namespace Ocean\Router;


use Ocean\Router\Exceptions\BadMethodException;
use Ocean\Router\Exceptions\RouteNotFoundException;
use Ocean\Router\Interfaces\MatchedRouteInterface;
use Ocean\Router\Interfaces\RouteCollectionInterface;
use Psr\Http\Message\RequestInterface;


class Matcher
{

    /**
     * @param  RequestInterface  $request
     * @param  RouteCollectionInterface  $collection
     *
     * @return MatchedRoute
     *
     * @throws RouteNotFoundException|BadMethodException
     */
    public function match(RequestInterface $request, RouteCollectionInterface $collection): MatchedRouteInterface
    {
        $routeFound = false;
        $methodEqual = false;

        foreach ($collection->getRouteList() as $route) {
            $currentRoutePath = preg_replace('/\{(\w+)}/ium', '(?<$1>[^/]+)', $route->getPath());
            if (preg_match('#^'.$currentRoutePath.'$#isum', $request->getUri()->getPath(), $matches)) {
                $routeFound = true;

                if ($request->getMethod() !== $route->getMethod()->name) {
                    continue;
                }
                $methodEqual = true;
                $currentRoute = $route;
                $route->mergeParametersAndRouteVars($matches);
            }
        }

        if (!$routeFound) {
            throw new RouteNotFoundException('Not found route');
        }
        if (!$methodEqual) {
            throw new BadMethodException('Method in route not equal');
        }

        return new MatchedRoute($currentRoute, $request);
    }
}