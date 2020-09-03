<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IsArrayOnSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/is_array_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(4, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(5, $this->getCoveredLines($filename)));
        $this->assertStringContainsString('is array', $this->output);
        $this->assertStringContainsString('is not array', $this->output);
    }
}