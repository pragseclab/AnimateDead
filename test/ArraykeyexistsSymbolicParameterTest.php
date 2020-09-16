<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ArraykeyexistsSymbolicParameterTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/arraykeyexists_symbolic_parameter.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $lines = $this->getCoveredLines($filename);
        $this->assertTrue(in_array(5, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(6, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(10, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(11, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(12, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(16, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(18, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(22, $this->getCoveredLines($filename)));
    }
}