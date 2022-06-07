<?php

namespace Ocean\Router\Interfaces;

interface RouteInterface
{
    /**
     * @return string
     */
    public function getPathRegex(): string;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @return array переданные переменные пользователем
     */
    public function getParameters(): array;

    /**
     * @return string
     */
    public function getHandler();

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return array переменные, полученные из роута /path/{$var1}/{$var2}
     */
//    public function getRouteVars(): array;
}