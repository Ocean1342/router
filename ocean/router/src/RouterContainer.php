<?php

namespace Ocean\Router;

class RouterContainer
{

    public RouteMap $routeMap;
    public Matcher $matcher;

    public function __construct()
    {
        $this->routeMap = new RouteMap();
    }

    public function getMap()
    {
        if (!$this->routeMap) {
            return $this->routeMap = new RouteMap();
        }
        return $this->routeMap;
    }

}