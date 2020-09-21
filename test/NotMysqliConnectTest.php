<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class NotMysqliConnectTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/not_mysqli_connect.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertFalse(in_array(4, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(7, $this->getCoveredLines($filename)));
    }
}