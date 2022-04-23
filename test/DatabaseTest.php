<?php
namespace SamtechSkripsi;

use PHPUnit\Framework\TestCase;
use SamtechSkripsi\Config\Database;

class DatabaseTest extends TestCase{
    public function testGetConection(){
        $connection = Database::getConection();
        self::assertNotNull($connection);
    }

    public function testGetConnectionSinggle(){
        $connection1=Database::getConection();
        $connection2=Database::getConection();
        self::assertSame($connection1,$connection2);
    }
}
