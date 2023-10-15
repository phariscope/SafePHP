<?php

namespace Phariscope\Tests;

use PHPUnit\Framework\TestCase;
use SafePHP\Exceptions\TypeValueException;

use function SafePHP\boolval;
use function SafePHP\floatval;
use function SafePHP\intval;
use function SafePHP\strval;

class ValTest extends TestCase
{
    public function testStrval(): void
    {
        $this->assertEquals("chaine 123", strval("chaine 123"));
        $this->assertEquals("123", strval(123));
        $this->assertEquals("1200", strval(1.2e3));
        $this->assertEquals("0.07", strval(7E-2));
        $this->assertEquals("1.234", strval(1.234));
        $this->assertEquals("1", strval(true));
        $this->assertEquals("", strval(false));
    }

    public function testTypeNotAcceptedForStrval(): void
    {
        $this->expectException(TypeValueException::class);
        $this->expectExceptionMessage("Cannot convert type value to string");
        strval(new \stdClass());
    }

    public function testIntval(): void
    {
        $this->assertEquals(123, intval(123));
        $this->assertEquals(123, intval("123"));
        $this->assertEquals(123, intval("   123  12 "));
        $this->assertEquals(0, intval("text123"));
        $this->assertEquals(1200, intval(1.2e3));
        $this->assertEquals(0, intval(7E-2));
        $this->assertEquals(1, intval(1.234));
        $this->assertEquals(1, intval(1.9));
        $this->assertEquals(1, intval(true));
        $this->assertEquals(0, intval(false));
    }

    public function testTypeNotAcceptedForIntval(): void
    {
        $this->expectException(TypeValueException::class);
        $this->expectExceptionMessage("Cannot convert type value to int");
        intval(new \stdClass());
    }

    public function testFloatval(): void
    {
        $this->assertEquals(123.456, floatval(123.456));
        $this->assertEquals(123, floatval("123"));
        $this->assertEquals(123, floatval("   123  12 "));
        $this->assertEquals(0, floatval("text123"));
        $this->assertEquals(1200, floatval(1.2e3));
        $this->assertEquals(0.07, floatval(7E-2));
        $this->assertEquals(1.234, floatval(1.234));
        $this->assertEquals(1.9, floatval(1.9));
        $this->assertEquals(1, floatval(true));
        $this->assertEquals(0, floatval(false));
    }

    public function testTypeNotAcceptedForFloatval(): void
    {
        $this->expectException(TypeValueException::class);
        $this->expectExceptionMessage("Cannot convert type value to float");
        floatval(new \stdClass());
    }

    public function testBoolval(): void
    {
        $this->assertEquals(1, boolval(true));
        $this->assertEquals(0, boolval(false));
        $this->assertEquals(0, boolval(0));
        $this->assertEquals(1, boolval(1));
        $this->assertEquals(true, boolval("123"));
        $this->assertEquals(true, boolval("   123  12 "));
        $this->assertEquals(true, boolval("text123"));
        $this->assertEquals(true, boolval(1.2e3));
        $this->assertEquals(true, boolval(7E-2));
        $this->assertEquals(true, boolval(1.234));
        $this->assertEquals(true, boolval(1.9));
    }

    public function testTypeNotAcceptedForBoolval(): void
    {
        $this->expectException(TypeValueException::class);
        $this->expectExceptionMessage("Cannot convert type value to bool");
        boolval(new \stdClass());
    }
}
