<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class NotBooleanObjectTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/not_boolean_object.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('event is an object - first try', $this->output);
        $this->assertStringContainsString('event is an object - second try', $this->output);
    }
}