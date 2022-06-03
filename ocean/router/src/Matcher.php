<?php

namespace Ocean\Router;


use Ocean\Router\Interfaces\RouteInterface;
use Ocean\Router\Interfaces\RouteMapInterface;
use Psr\Http\Message\RequestInterface;

class Matcher
{
    /** psalm? */
    protected RouteInterface $matchedRoute;

    /**
     * @psalm-var RequestInterface
     * @psalm-var RouteMapInterface
     *
     * @psalm-return RouteInterface|null
     */
    public function match(RequestInterface $request, RouteMapInterface $map): ?RouteInterface
    {

        foreach ($map->getRouteList() as $route) {

            // matching route and request uri
            if (preg_match($route->getRegex(), $request->getUri()->getPath(), $matchesInUri)) {
                $routeFound = true;

                if ($request->getMethod() !== $route->getMethod()) {
                    continue;
                }
                $methodEqual = true;

                // add route vars to Route object Пока не передаём переменные в роут

/*                unset($matchesInUri[0]);
                foreach ($matchesInUri as $k => $match) {
                    $route->setVarsValue(--$k, $match);
                }*/
                $currentRoute = $route;
            }
        }
        if($currentRoute) {
            return $currentRoute;
        } else {
            return null;
        }


    }
}