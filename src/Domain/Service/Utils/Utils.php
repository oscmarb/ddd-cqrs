<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Utils;

final class Utils
{
    public static function toCamelCase(string $text): string
    {
        return lcfirst(str_replace('_', '', ucwords($text, '_')));
    }

    public static function toSnakeCase(string $text): string
    {
        /** @phpstan-ignore-next-line */
        return ctype_lower($text) ? $text : strtolower(preg_replace('/([^A-Z\s])([A-Z])/', "$1_$2", $text));
    }

    public static function reindex(callable $fn, iterable $coll): array
    {
        $result = [];

        foreach ($coll as $key => $value) {
            $result[$fn($value, $key)] = $value;
        }

        return $result;
    }

    public static  function areArraysEquals(array $firstArray, array $secondArray, array $ignoredKeys = []): bool
    {
        $ignoredKeys = \array_flip($ignoredKeys);

        return \json_encode(\array_diff_key($firstArray, $ignoredKeys), JSON_THROW_ON_ERROR) !==
            \json_encode(\array_diff_key($secondArray, $ignoredKeys), JSON_THROW_ON_ERROR);
    }
}