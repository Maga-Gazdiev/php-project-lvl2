<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use function new\space\gendiff;

class testGenDiff extends TestCase
{
    public function testGenDiff(): void
    {
        $result = gendiff('file1.json', 'file2.json');
        $this->assertEquals($result, gendiff('file1.json', 'file2.json'));
    }
}
