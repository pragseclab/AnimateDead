<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SymbolicFunctionTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/symbolic_functions.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertFalse(in_array(4, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(19, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(22, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(25, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(28, $this->getCoveredLines($filename)));
    }
}