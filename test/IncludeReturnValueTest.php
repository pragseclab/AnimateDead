<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IncludeReturnValueTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/include_return_value.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('No errors in config file', $this->output);
        $this->assertStringNotContainsString('Errors in config file', $this->output);
    }
}