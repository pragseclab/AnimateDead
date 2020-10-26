<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ArrayFilterClosureCallbackTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/array_filter_closure_callback.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('key without slash', $this->output);
        $this->assertStringNotContainsString('key with slash', $this->output);
    }
}