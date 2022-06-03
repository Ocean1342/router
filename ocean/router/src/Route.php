<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\RouteInterface;

class Route implements RouteInterface
{
    protected array $varsNames;
    /**
     * регулярное выражение для сопоставления с урлом
     *
     * @var non-empty-string
     */
    protected string $regex;


    /**
     * @param string $name
     * @param non-empty-string $path
     * @param $handler
     * @param array $parameters
     * @param string $method
     */
    public function __construct(
        protected string $name,
        protected string $path,
        protected        $handler,
        protected array  $parameters = [],
        protected string $method = "GET"

    )
    {
        $this->regex = RegexHelper::prepareRegex($this->path);
    }

    /**
     *
     * @return non-empty-string
     */
    public function getRegex(): string
    {
        return $this->regex;
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
     * @return array
     */
    public function getRouteVars(): array
    {
        return $this->varsNames;
    }


}