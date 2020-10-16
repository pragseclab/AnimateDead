<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class VariableVariableTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/variable_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('Hello', $this->output);
        $this->assertStringContainsString('World', $this->output);
        $this->assertStringContainsString('Foo', $this->output);
        $this->assertStringContainsString('Bar', $this->output);
        $this->assertStringContainsString('a', $this->output);
    }
}