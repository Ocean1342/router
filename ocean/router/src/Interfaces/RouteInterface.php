<?php

namespace Ocean\Router\Interfaces;

interface RouteInterface
{
    /**
     * @return string
     */
    public function getRegex(): string;


    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @return array
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
     * @return array
     */
    public function getRouteVars(): array;
}