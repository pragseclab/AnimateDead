<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IsTypeCheckOnSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/is_typecheck_on_symbol.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('is valid', $this->output);
        $this->assertStringContainsString('is not valid', $this->output);
    }
}