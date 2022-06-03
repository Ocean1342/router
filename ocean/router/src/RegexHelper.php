<?php

namespace Ocean\Router;


/**
 * Класс должен подготавливать регулярные выражения для роута
 * Цель класса - уменьшение сложности работы с классом Роута, т.е. это коллекция методов для работы с регулярками
 * Все данные нужно брать из роута
 *
 * */
class RegexHelper
{
    /**
     * регулярка для вычленения переменных из урла
     *
     * @var non-empty-string $dynamicPartRegex
     */
    public static string $dynamicPartRegex = '([^\/]+)';

    /**
     * перегоняет урл в регулярное выражение
     *
     * @param non-empty-string $rawPath
     * @return non-empty-string
     */
    public static function prepareRegex(string $rawPath): string
    {
        if (preg_match_all('/{' . static::$dynamicPartRegex . '}/i', $rawPath, $matches)) {
            //Prepare regex
            unset($matches[0]);
            $newRegexPattern = preg_replace('/{(.*)}/i', '', $rawPath);
            $regex = '/^' . str_replace('/', '\/', $newRegexPattern);

            $regex = static::getRegex($matches[1], $regex);
        } else {
            $regex = '/^' . str_replace('/', '\/', $rawPath) . '$/i';
        }

        return $regex;
    }

    /**
     * @param $matches
     * @param string $regex
     * @return string
     */
    public static function getRegex($matches, string $regex): string
    {
        foreach ($matches as $k => $match) {
//            $this->setVarName($match);
            $regex .= static::$dynamicPartRegex;
            if ($k == (count($matches) - 1)) {
                $regex .= '$/i';
            } else {
                $regex .= '\/';
            }
        }
        return $regex;
    }

    /**
     * что с переменными роута?
     */
}