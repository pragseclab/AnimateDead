<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SpecialClassConstantTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/special_class_constant.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('Composer\Autoload\ClassLoader', $this->output);
    }
}