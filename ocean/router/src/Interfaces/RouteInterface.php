<?php

namespace Ocean\Router\Interfaces;

interface RouteInterface
{
    /**
     * Возвращает регулярное выражение роута
     *
     * @return string
     */
    public function getPathRegex(): string;

    /**
     * HTTP-method роута
     * @return string
     */
    public function getMethod(): string;

    /**
     * Шаблон урла, зарегестрированный пользователем
     *
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
     * Возвращает имя роута
     *
     * @return string
     */
    public function getName(): string;

}