<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IfSymbolAndFalseTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/if_symbol_and_false.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringNotContainsString('inside if', $this->output);
        $this->assertStringContainsString('outside if', $this->output);
    }
}