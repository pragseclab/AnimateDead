<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ClassSelfTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/class_self.test.php';
        $method = 'GET';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('we should get here without errors', $this->output);
    }
}