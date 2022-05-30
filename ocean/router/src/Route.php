<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\RouteInterface;

class Route implements RouteInterface
{
    protected array $varsNames;
    protected string $regex;

    public function __construct(
        protected string $name,
        protected string $rawPath,
        protected $handler,
        protected array  $parameters = [],
        protected string $method = "GET"

    )
    {
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }


    /**
     * @return string
     */
    public function getRawPath(): string
    {
        return $this->rawPath;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getHandler(): string
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getRouteVars(): array
    {
        return $this->varsNames;
    }


}