<?php

use Connectors\CurlConnection;
use Connectors\MysqlConnection;
use PHPUnit\Framework\TestCase;

final class SingletonTest extends TestCase
{
    
    public function testCurlConnectionCannotBeInstantiated(): void {
        $this->expectError(\Exception::class);

        new CurlConnection();
    }
    
    public function testMysqlConnectionCannotBeInstantiated(): void {
        $this->expectError(\Exception::class);

        new MysqlConnection();
    }

}