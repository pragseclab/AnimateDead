<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class FunctionReturnSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/function_return_symbol.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(7, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(9, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(13, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(16, $this->getCoveredLines($filename)));
    }
}