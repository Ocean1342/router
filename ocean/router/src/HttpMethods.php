<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\MethodsInterface;

/**
 * @template Enum
 * @psalm-return object of Enum
 */
enum HttpMethods implements MethodsInterface
{
    case GET;
    case POST;
    case PUT;
    case DELETE;
    case HEAD;
}