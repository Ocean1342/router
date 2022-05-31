<?php

namespace Ocean\Router;

class RouterContainer
{

    public RouteMap $routeMap;
    public Matcher $matcher;

    public function __construct()
    {
        $this->routeMap = new RouteMap();
        $this->matcher = new Matcher();
    }

    public function getMap()
    {
        if (!$this->routeMap) {
            return $this->routeMap = new RouteMap();
        }
        return $this->routeMap;
    }

    public function getMatcher()
    {
        if (!$this->matcher) {
            return $this->matcher = new Matcher();
        }
        return $this->matcher;
    }


}