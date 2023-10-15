<?php

namespace Phariscope\Tests;

use PHPUnit\Framework\TestCase;
use SafePHP\Exceptions\HashFileException;

use function SafePHP\hash_file;

class HashTest extends TestCase
{
    public function testHashFile(): void
    {
        $filename = __DIR__ . "/../src/hash.php";
        $this->assertIsString(hash_file("md2", $filename));
    }

    public function testBadFilename(): void
    {
        $this->expectException(HashFileException::class);
        $this->expectExceptionMessage("hash_file(md2, badFilename, false): \nFile 'badFilename' not found");
        hash_file("md2", "badFilename");
    }
}
