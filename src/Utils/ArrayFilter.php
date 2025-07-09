<?php

declare(strict_types=1);

namespace App\Utils;

class ArrayFilter
{
    // pass by reference to avoid creating new arrays - manipulates the original array so no need to return anything
    /**
     * @param array<mixed> $array
     */
    public static function removeEmptyKeysRecursively(array &$array): void
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                // if value is an array, recursively call the function to remove empty keys
                self::removeEmptyKeysRecursively($value);
            }

            if ($value === null || $value === '') {
                unset($array[$key]);
            }
        }
    }
}
