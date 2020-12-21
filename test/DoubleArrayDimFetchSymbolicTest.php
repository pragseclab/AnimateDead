<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class DoubleArrayDimFetchSymbolicTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/double_arraydimfetch_symbolic_variable.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('If is true', $this->output);
        $this->assertStringContainsString('If is not true', $this->output);
    }
}