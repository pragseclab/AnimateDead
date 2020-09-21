<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class MySqliQueryNumRowsSymbolicVariableTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/mysqli_query_numrows_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('User ID exists in the database', $this->output);
        $this->assertStringContainsString('User ID is MISSING from the database', $this->output);
    }
}