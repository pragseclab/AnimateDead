<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ClassDestructorTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/class_destructor.test.php';
        $method = 'GET';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('Destructing object with: property_value', $this->output);
    }
}