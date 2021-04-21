<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class EqualsStringSymbolicVariableTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/equals_string_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(4, $this->getCoveredLines($filename)));
        $this->assertStringContainsString('PMA_BYPASS_GET_INSTANCE is undefined', $this->output);
    }
}