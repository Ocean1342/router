<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\MatchedRouteInterface;
use Ocean\Router\Interfaces\RouteInterface;
use Psr\Http\Message\RequestInterface;

class MatchedRoute implements MatchedRouteInterface
{

    public function __construct(
        protected RouteInterface $route,
        protected RequestInterface $request
    ) {
    }

    /**
     * @return RouteInterface
     */
    public function getRoute(): RouteInterface
    {
        return $this->route;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getParameters(): array
    {
        return $this->route->getParameters();
    }

    public function getMethod(): string
    {
        return $this->request->getMethod();
    }

}