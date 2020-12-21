<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SymbolicValueTransferTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/symbolic_value_transfer.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        echo ob_get_level().PHP_EOL;
        $this->assertTrue(in_array(9, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(12, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(16, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(19, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(23, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(26, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(30, $this->getCoveredLines($filename)));
        $this->assertFalse(in_array(33, $this->getCoveredLines($filename)));
    }
}