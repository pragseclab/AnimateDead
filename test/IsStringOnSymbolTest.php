<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IsStringOnSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/isstring_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(4, $this->getCoveredLines($filename)));
        $this->assertFalse(in_array(6, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(8, $this->getCoveredLines($filename)));
    }
}