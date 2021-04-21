<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class RandomBytesTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/random_bytes.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('Random: ', $this->output);
    }
}