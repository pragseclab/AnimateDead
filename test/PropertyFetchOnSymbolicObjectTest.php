<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class PropertyFetchOnSymbolicObjectTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/property_fetch_on_symbolic_object.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('There is no error', $this->output);
        $this->assertStringContainsString('There is an error', $this->output);
    }
}