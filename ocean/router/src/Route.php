<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\RouteInterface;

class Route implements RouteInterface
{
    /**
     * @var array
     */
    protected array $routeVars;

    /**
     * Regex to check with url
     *
     * @psalm-var  non-empty-string
     */
    protected string $pathRegex;

    /**
     * @var RouteHelper
     */
    public routeHelper $routeHelper;

    /**
     * @param string $name short route name
     * @psalm-param non-empty-string $path user-registered route url
     * @param $handler callable route handler
     * @param array $parameters user-registered parameters
     * @param string $method HTTP-method
     */
    public function __construct(
        protected string $name,
        protected string $path,
        protected        $handler,
        protected array  $parameters = [],
        protected string $method = "GET"

    )
    {
        $this->routeHelper = new RouteHelper();
        $this->pathRegex = $this->routeHelper->createRegexPath($this->path);

    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function setVar(mixed $key, mixed $value): void
    {
        $this->routeVars[$key] = $value;
    }

    /**
     *
     * @return non-empty-string
     */
    public function getPathRegex(): string
    {
        return $this->pathRegex;
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
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     *
     */
    public function getHandler(): callable
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
     * Combines passed parameters and variables taken from the route
     *
     */
    public function mergeParametersAndRouteVars(): void
    {
        $this->parameters = array_merge($this->getParameters(), $this->routeHelper->arVariables);
    }


}