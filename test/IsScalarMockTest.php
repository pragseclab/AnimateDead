<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IsScalarMockTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/is_scalar_mock.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('a is scalar', $this->output);
        $this->assertStringContainsString('POST[a] is scalar', $this->output);
    }
}