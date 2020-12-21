<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class MySqliEscapeStringSymbolicVariableTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/mysqli_real_escape_string_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('SymbolicVariable', $this->output);
    }
}