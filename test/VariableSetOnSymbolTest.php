<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class VariableSetOnSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/variable_set_on_symbol.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('default theme', $this->output);
    }
}