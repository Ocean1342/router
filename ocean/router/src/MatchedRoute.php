<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\MatchedRouteInterface;
use Ocean\Router\Interfaces\MethodsInterface;
use Ocean\Router\Interfaces\RouteInterface;
use Psr\Http\Message\RequestInterface;

class MatchedRoute implements MatchedRouteInterface
{

    public function __construct(
        protected RouteInterface $route,
        protected RequestInterface $request
    )
    {
    }

    public function getRoute(): RouteInterface
    {
        return $this->route;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getParams(): iterable
    {
        return $this->route->getParameters();
    }

    public function getMethod(): string
    {
        return $this->request->getMethod();
    }

}