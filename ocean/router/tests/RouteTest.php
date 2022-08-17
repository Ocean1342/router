<?php

namespace Ocean\Router\Tests;

use Ocean\Router\Route;
use PHPUnit\Framework\TestCase;

/**
 * @group routeGroup
 */
class RouteTest extends TestCase
{

    public function routePathProvider(): array
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

    public function routeRegexPathProvider(): array
    {
        return [
            ['/test/foo/bar', '/^\/test\/foo\/bar$/i'],
            ['/test/{user}/{id}', '/^\/test\/([^\/]+)\/([^\/]+)$/i']
        ];
    }

    public function routeVarsProvider(): array
    {
        return [
            [[], 1],
            [['var' => 1], 2],
            [
                [
                    'var' => 1,
                    '1' => 1,
                    3 => 1
                ],
                2
            ],

        ];
    }

    /**
     * @dataProvider routeVarsProvider
     */
    public function testMergeParametersAndRouteVars($varsArray, $expectedCount)
    {
        $route = new Route('test', '/', function () {
        }, ['param1' => 'test']);
        $route->mergeParametersAndRouteVars($varsArray);
        $this->assertCount($expectedCount, $route->getParameters());
    }

    /**
     * @dataProvider routeRegexPathProvider
     */
    /*    public function testRegExPath($path, $expectedRegexPath)
        {
            $route = new Route('test', $path, function () {
                echo 'hello';
            });
            $this->assertSame($expectedRegexPath, $route->getPathRegex());
        }*/
}