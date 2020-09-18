<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class EmptySymbolicVariableTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/empty_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('Condition is true', $this->output);
        $this->assertStringContainsString('Condition is false', $this->output);
    }
}