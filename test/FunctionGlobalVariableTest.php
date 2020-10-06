<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class FunctionGlobalVariableTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/function_global_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(19, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(20, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(32, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(33, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(34, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(35, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(36, $this->getCoveredLines($filename)));
    }
}