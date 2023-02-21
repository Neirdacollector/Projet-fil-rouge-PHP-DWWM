<?php 

require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../inc/functions.inc.php';
use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase{
    public function testAdd(){
        $this -> assertEquals(11, add(5,6));
    }
}
// .\vendor\bin\phpunit.bat .\test\UtilTest.php
?>