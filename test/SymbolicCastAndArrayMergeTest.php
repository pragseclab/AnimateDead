<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SymbolicCastAndArrayMergeTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/array_merge_symbolic_arrays.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(7, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(10, $this->getCoveredLines($filename)));
    }
}