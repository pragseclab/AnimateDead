<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IsObjectGlobalVariableSymbolicTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/is_object_global_variable_symbolic.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('Inside if', $this->output);
        $this->assertStringContainsString('Do we get here?', $this->output);
    }
}