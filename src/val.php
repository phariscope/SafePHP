<?php

namespace SafePHP;

use SafePHP\Exceptions\NotAcceptableTypeValue;

/**
 * Get the string value of a variable. See the documentation on string for more information on converting to string.
 *
 * This function performs no formatting on the returned value.
 * If you are looking for a way to format a numeric value as a string, please see sprintf() or number_format().
 *
 * @param mixed $value The variable that is being converted to a string.
 *
 * value may be any scalar type, null, or an object that implements the __toString() method.
 * You cannot use strval() on arrays or on objects that do not implement the __toString() method.
 *
 * @return string The string value of value.
 * @throws NotAcceptableTypeValue
 */
function strval(mixed $value): string
{
    if (
        is_bool($value) ||
        is_float($value) ||
        is_int($value) ||
        is_resource($value) ||
        is_string($value) ||
        is_null($value)
    ) {
        return \strval($value);
    }
    throw new NotAcceptableTypeValue("Cannot convert type value to string");
}

/**
 * Get the integer value of a variable.
 * @param mixed $value
 * @return int
 * @throws NotAcceptableTypeValue
 */
function intval(mixed $value): int
{
    if (
        is_bool($value) ||
        is_float($value) ||
        is_int($value) ||
        is_resource($value) ||
        is_string($value) ||
        is_null($value)
    ) {
        return \intval($value);
    }
    throw new NotAcceptableTypeValue("Cannot convert type value to int");
}

/**
 *
 * @param mixed $value
 * @return float
 * @throws NotAcceptableTypeValue
 */
function floatval(mixed $value): float
{
    if (
        is_bool($value) ||
        is_float($value) ||
        is_int($value) ||
        is_resource($value) ||
        is_string($value) ||
        is_null($value)
    ) {
        return \floatval($value);
    }
    throw new NotAcceptableTypeValue("Cannot convert type value to float");
}

function boolval(mixed $value): bool
{
    if (
        is_bool($value) ||
        is_float($value) ||
        is_int($value) ||
        is_resource($value) ||
        is_string($value) ||
        is_null($value)
    ) {
        return \boolval($value);
    }
    throw new NotAcceptableTypeValue("Cannot convert type value to bool");
}
