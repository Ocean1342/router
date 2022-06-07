<?php

namespace Ocean\Router;


use phpDocumentor\Reflection\Types\Void_;

/**
 * Класс должен подготавливать регулярные выражения для роута
 * Цель класса - уменьшение сложности работы с классом Роута, т.е. это коллекция методов для работы с регулярками
 * Все данные нужно брать из роута
 *
 * */
class RouteHelper
{
    /**
     * регулярка для вычленения переменных из урла - {id}
     *
     * @var non-empty-string $dynamicPartRegex
     */
    public string $dynamicPartRegex = '([^\/]+)';

    /**
     * Имена переменных из $raw
     *
     * @psalm-var list<string>
     */
    protected array $varNames = [];

    public array $arVariables;

    /**
     * перегоняет урл в регулярное выражение
     *
     * @param non-empty-string $path
     * @return non-empty-string
     */
    public function createRegexPath(string $path): string
    {
        /**
         * @var array $varsNamesFromRawPathFromRoute
         * имена переменных в $path роута вида /{id}
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
     * Метод Создаёт финальный вариант регулярного выражения для $path с переменными
     *
     * @param $varsNamesFromRawPathFromRoute
     * @param string $regex
     * @return string
     */
    public function generateFinalDynamicRegex($varsNamesFromRawPathFromRoute, string $regex): string
    {
        foreach ($varsNamesFromRawPathFromRoute as $k => $varName) {
            //тут заводим имена
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
     * Сохраняет имена переменных из $rawPath
     */
    public function setVarName(string $varName): void
    {
        $this->varNames[] = $varName;
    }

    /**
     * Возвращает массив с именами переменных из $path
     * @return array
     */
    public function getVarNames(): array
    {
        return $this->varNames;
    }

    /**
     * @psalm-var list<mixed> $value
     * @return void
     */
    public function setVarValues(int $index, mixed $value): void
    {
        $this->arVariables[$this->varNames[$index]] = $value;
    }

}