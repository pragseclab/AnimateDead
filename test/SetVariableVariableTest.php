<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SetVariableVariableTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/set_variable_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('array(3) {', $this->output);
    }
}