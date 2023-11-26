<?php

namespace Phariscope\Tests;

use PHPUnit\Framework\TestCase;
use SafePHP\Exceptions\UndefinedEnvException;

use function SafePHP\getenv;
use function SafePHP\getenvOrWithENV;

class GetenvTest extends TestCase
{
    /** @var null|string|array<mixed> */
    private null|string|array $initialEnv;

    public function setUp(): void
    {
        $this->initialEnv = \getenv('MY_ENV') === false ? null : \getenv('MY_ENV');
        if ($this->initialEnv === null) {
            $this->initialEnv = isset($_ENV['MY_ENV']) ? $_ENV['MY_ENV'] : null;
        }
        putenv('MY_ENV');
    }

    public function tearDown(): void
    {
        if (null !== $this->initialEnv && !is_array($this->initialEnv)) {
            putenv('MY_ENV=' . $this->initialEnv);
        } else {
            putenv('MY_ENV');
            unset($_ENV['MY_ENV']);
        }
    }

    public function testUndefinedException(): void
    {
        $this->expectException(UndefinedEnvException::class);
        $this->expectExceptionMessage("Undefined environment variable: MY_ENV");
        getenv('MY_ENV');
    }

    public function testUndefinedExceptionAlthougMYENV(): void
    {
        $_ENV['MY_ENV'] = 'my_env_value';
        $this->expectException(UndefinedEnvException::class);
        $this->expectExceptionMessage(
            "Undefined environment variable with getenv: MY_ENV, but exist with \$_ENV: my_env_value"
        );
        getenv('MY_ENV');
    }

    public function testGetenvSimple(): void
    {
        putenv('MY_ENV=my_env_value');
        $this->assertEquals('my_env_value', getenv('MY_ENV'));
    }

    public function testGetenvAllEnvs(): void
    {
        putenv('MY_ENV=my_env_value');
        $envs = getenv();
        $this->assertIsArray($envs);
        $this->assertEquals('my_env_value', $envs['MY_ENV']);
    }

    public function testGetenvWithLocalOnly(): void
    {
        putenv('MY_ENV=my_env_value');
        $this->assertEquals('my_env_value', getenv('MY_ENV', true));
    }

    public function testGetenvOrENV(): void
    {
        $_ENV['MY_ENV'] = 'my_env_value';
        $this->assertEquals('my_env_value', getenvOrWithENV('MY_ENV'));
    }

    public function testGetenvOrWithENV(): void
    {
        $this->expectException(UndefinedEnvException::class);
        $this->expectExceptionMessage("Undefined environment variable neither getenv nor \$_ENV: MY_ENV");
        getenvOrWithENV('MY_ENV');
    }

    public function testGetenvOrWithENVpassingWithgetenv(): void
    {
        putenv('MY_ENV=my_env_value');
        $this->assertEquals('my_env_value', getenvOrWithENV('MY_ENV'));
    }
}
