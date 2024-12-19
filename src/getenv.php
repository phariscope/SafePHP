<?php

namespace SafePHP;

use SafePHP\Exceptions\UndefinedEnvException;

 /**
  * getenv — Gets the value of a single or all environment variables
  *
  *  Gets the value of a single or all environment variables.
  *
  * You can see a list of all the environmental variables by using phpinfo().
  * Many of these variables are listed within » RFC 3875, specifically section 4.1, "Request Meta-Variables".
  *
  * @param ?string $name The variable name as a string or null.
  * @param bool $local_only When set to true, only local environment variables are returned,
  *     set by the operating system or putenv. It only has an effect when name is a string.
  * @return array<string|mixed>|string Returns the value of the environment variable name, or false if the environment
  *      variable name does not exist. If name is null, all environment variables are returned as an associative array.
  * @throws UndefinedEnvException
  */
function getenv(?string $name = null, bool $local_only = false): array|string // @phpstan-ignore-line because of never
{
//returns array<mixed> so it can be removed from the return type.

    $env = \getenv($name, $local_only); // @phpstan-ignore-line bacause Parameter #1 $varname of function
    //getenv expects string, string|null given.
    if ($env === false) {
        if (isset($_ENV[$name])) {
            throw new UndefinedEnvException(
                sprintf(
                    "Undefined environment variable with getenv: %s, but exist with \$_ENV: %s",
                    $name,
                    strval($_ENV[$name])
                )
            );
        }
        throw new UndefinedEnvException("Undefined environment variable: $name");
    }
    return $env;
}

function getenvOrWithENV(string $name): string
{
    $env = \getenv($name);
    if ($env === false) {
        if (isset($_ENV[$name])) {
            if (!is_string($_ENV[$name])) {
                throw new UndefinedEnvException("Undefined environment variable : $name must be a string");
            }
            return $_ENV[$name];
        }
        throw new UndefinedEnvException("Undefined environment variable neither getenv nor \$_ENV: $name");
    }
    return $env;
}
