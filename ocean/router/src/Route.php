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
     * регулярное выражение для сопоставления с урлом
     *
     * @var non-empty-string
     */
    protected string $pathRegex;

    /**
     * @var RouteHelper
     */
    public routeHelper $routeHelper;

    /**
     * @param string $name короткое имя роута
     * @param non-empty-string $path зарегистрированный пользователем урл роута
     * @param $handler обработчик роута
     * @param array $parameters зарегистрированные переменные пользователем
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
        $this->routeHelper = new RouteHelper();
        $this->pathRegex = $this->routeHelper->createRegexPath($this->path);

    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function setVar(mixed $key,mixed $value): void
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
     * Объединяет переданные параметры и переменные взятые из роута
     *
     */
    public function mergeParametersAndRouteVars(): void
    {
        $this->parameters = array_merge($this->getParameters(), $this->routeHelper->arVariables);
    }


}