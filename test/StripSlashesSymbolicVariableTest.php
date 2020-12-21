<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class StripSlashesSymbolicVariableTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/stripslashes_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringNotContainsString('Windows', $this->output);
        $this->assertStringContainsString('*nix', $this->output);
        $this->assertStringContainsString('You have entered an invalid IP', $this->output);
        $this->assertStringContainsString('SymbolicVariable', $this->output);
    }
}