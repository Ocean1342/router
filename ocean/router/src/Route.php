<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\MethodsInterface;
use Ocean\Router\Interfaces\RouteInterface;

class Route implements RouteInterface
{
    protected array $routeVars;

    /**
     * @psalm-param non-empty-string $path user-registered route url
     * @psalm-param non-empty-string $name user-registered route url
     * @psalm-param callable|class-string<callable> $handler
     */
    public function __construct(
        protected string $name,
        protected string $path,
        protected $handler,
        protected array $parameters = [],
        protected MethodsInterface $method = HttpMethods::GET

    ) {
    }

    public function getMethod(): MethodsInterface
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getHandler(): callable
    {
        return $this->handler;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Combines passed parameters and variables taken from the route
     *
     * @psalm-param array{varName: string, varValue: mixed}|array{} $ar
     * @return void
     */
    public function mergeParametersAndRouteVars(array $ar = []): void
    {
        if (!empty($ar)) {
            foreach ($ar as $k => $v) {
                if (is_numeric($k)) {
                    unset($ar[$k]);
                }
            }
        } else {
            return;
        }
        $this->parameters = array_merge(
            $this->getParameters(),
            $ar
        );
    }


}