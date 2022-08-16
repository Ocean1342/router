<?php

namespace Ocean\Router;

use Ocean\Router\Interfaces\MethodsInterface;

enum HttpMethods implements MethodsInterface
{
    case GET;
    case POST;
    case PUT;
    case DELETE;
    case HEAD;
}