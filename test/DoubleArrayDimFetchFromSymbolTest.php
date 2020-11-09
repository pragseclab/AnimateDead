<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class DoubleArrayDimFetchFromSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/double_arraydimfetch_from_symbol.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('is set', $this->output);
        $this->assertStringContainsString('is not set', $this->output);
    }
}