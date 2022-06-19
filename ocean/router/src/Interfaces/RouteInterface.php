<?php

namespace Ocean\Router\Interfaces;

interface RouteInterface
{
    /**
     * Route regex
     *
     * @return string
     */
    public function getPathRegex(): string;

    /**
     * HTTP-method
     * @return string
     */
    public function getMethod(): string;

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
     * @return string
     */
    public function getHandler();

    /**
     * Route name
     *
     * @return string
     */
    public function getName(): string;

}