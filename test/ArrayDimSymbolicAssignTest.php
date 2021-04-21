<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ArrayDimSymbolicAssignTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/arraydim_assign_from_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(20, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(26, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(29, $this->getCoveredLines($filename)));
    }
}