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
  * @param null|string $name The variable name as a string or null.
  * @param bool $local_only When set to true, only local environment variables are returned,
  *     set by the operating system or putenv. It only has an effect when name is a string.
  * @return string|array<mixed> Returns the value of the environment variable name, or false if the environment
  *      variable name does not exist. If name is null, all environment variables are returned as an associative array.
  * @throws UndefinedEnvException
  */
function getenv(?string $name = null, bool $local_only = false): string|array
{
    /** @var string $name without this comment stan will give strange "getenv expects string, string|null given." */
    $env = \getenv($name, $local_only);
    if ($env === false) {
        if (isset($_ENV[$name])) {
            throw new UndefinedEnvException(
                "Undefined environment variable with getenv: $name, but exist with \$_ENV: {$_ENV[$name]}"
            );
        }
        throw new UndefinedEnvException("Undefined environment variable: $name");
    }
    /** @var string|array<mixed> */
    return $env;
}

function getenvOrWithENV(string $name): string
{
    $env = \getenv($name);
    if ($env === false) {
        if (isset($_ENV[$name])) {
            return $_ENV[$name];
        }
        throw new UndefinedEnvException("Undefined environment variable neither getenv nor \$_ENV: $name");
    }
    return $env;
}
