<?php

namespace Ocean\Router\Interfaces;

use Psr\Http\Message\RequestInterface;

interface MatchedRouteInterface
{
    public function getRoute(): RouteInterface;

    public function getRequest(): RequestInterface;

}