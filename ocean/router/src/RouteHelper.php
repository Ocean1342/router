<?php

namespace Ocean\Router;

/**
 * The class must prepare regex for the route
 * Target class - reducing the complexity of working with Route,
 * i.e. this is a collection of methods for working with regular expressions, route variables etc.
 * All data must be collected from the route
 *
 * */
class RouteHelper
{
    /**
     * Regex for isolating variables from the url - {id}
     *
     * @psalm-var  non-empty-string $dynamicPartRegex
     */
    public string $dynamicPartRegex = '([^\/]+)';

    /**
     * Имена переменных из $raw
     *
     * @psalm-var list<string>
     */
    protected array $varNames = [];

    public array $arVariables = [];

    /**
     * transform path to regex
     *
     * @psalm-param non-empty-string $path
     * @psalm-return non-empty-string
     */
    public function createRegexPath(string $path): string
    {
        /**
         * @var array $varsNamesFromRawPathFromRoute
         * vars names from route $path like /{id}
         */
        if (preg_match_all('/{' . $this->dynamicPartRegex . '}/i', $path, $varsNamesFromRawPathFromRoute)) {
            //Prepare regex
            unset($varsNamesFromRawPathFromRoute[0]);

            $newRegexPattern = preg_replace('/{(.*)}/i', '', $path);
            $regex = '/^' . str_replace('/', '\/', $newRegexPattern);

            $regex = $this->generateFinalDynamicRegex($varsNamesFromRawPathFromRoute[1], $regex);
        } else {
            $regex = '/^' . str_replace('/', '\/', $path) . '$/i';
        }

        return $regex;
    }

    /**
     * Final regex for $path with variables
     *
     * @param $varsNamesFromRawPathFromRoute
     * @param string $regex
     * @return string
     */
    public function generateFinalDynamicRegex($varsNamesFromRawPathFromRoute, string $regex): string
    {
        foreach ($varsNamesFromRawPathFromRoute as $k => $varName) {
            //put names here
            $this->setVarName($varName);
            $regex .= $this->dynamicPartRegex;
            if ($k == (count($varsNamesFromRawPathFromRoute) - 1)) {
                $regex .= '$/i';
            } else {
                $regex .= '\/';
            }
        }
        return $regex;
    }

    /**
     * Save variable names from $rawPath
     */
    public function setVarName(string $varName): void
    {
        $this->varNames[] = $varName;
    }

    /**
     * Returns an array with variable names from $path
     * @return array
     */
    public function getVarNames(): array
    {
        return $this->varNames;
    }

    /**
     * Set variables values
     *
     * @psalm-var list<mixed> $value
     * @return void
     */
    public function setVarValues(int $index, mixed $value): void
    {
        $this->arVariables[$this->varNames[$index]] = $value;
    }

}