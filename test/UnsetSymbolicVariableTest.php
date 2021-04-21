<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class UnsetSymbolicVariableTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/unset_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('unset_symbolic_variable.test.php:5', $this->output);
    }
}