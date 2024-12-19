<?php

namespace Phariscope\Tests;

use PHPUnit\Framework\TestCase;
use SafePHP\Exceptions\HashFileException;

use function SafePHP\hash_file;

class HashTest extends TestCase
{
    public function testHashFile(): void
    {
        $filename = __DIR__ . "/resources/welcomeToBeHashed.txt";
        $hash = hash_file("md2", $filename);
        $this->assertEquals("1cb1526acff00c70d2a3707d1d22d565", $hash);
    }

    public function testBadFilename(): void
    {
        $this->expectException(HashFileException::class);
        $this->expectExceptionMessage("hash_file(md2, badFilename, false): \nFile 'badFilename' not found");
        hash_file("md2", "badFilename");
    }
}
