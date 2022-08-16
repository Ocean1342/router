<?php

namespace Ocean\Router\Interfaces;

interface RouteInterface
{

    /**
     * HTTP-method
     * @return MethodsInterface
     */
    public function getMethod(): MethodsInterface;

    /**
     * User-registered path
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * @return array user params
     */
    public function getParameters(): array;

    /**
     * @return mixed
     */
    public function getHandler(): mixed;


}