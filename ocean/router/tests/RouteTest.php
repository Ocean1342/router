<?php

use Ocean\Router\Route;
use PHPUnit\Framework\TestCase;

/**
 * @group routeGroup
 */
class RouteTest extends TestCase
{

    public function routePathProvider()
    {
        return [
            ['simple-route', '/test/foo/bar'],
            ['dynamic-route', '/test/{user}/{id}'],
        ];
    }

    /**
     * @dataProvider routePathProvider
     */
    public function testPath($name, $path)
    {
        $route = new Route($name, $path, function () {
            echo 'hello';
        });

        $this->assertSame($path, $route->getPath());
    }

    public function routeRegexPathProvider()
    {
        return [
            ['/test/foo/bar', '/^\/test\/foo\/bar$/i'],
            ['/test/{user}/{id}', '/^\/test\/([^\/]+)\/([^\/]+)$/i']
        ];
    }

    /**
     * @dataProvider routeRegexPathProvider
     */
    public function testRegExPath($path, $expectedRegexPath)
    {
        $route = new Route('test', $path, function () {
            echo 'hello';
        });
        $this->assertSame($expectedRegexPath, $route->getPathRegex());
    }
}