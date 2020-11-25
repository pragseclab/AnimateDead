<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ArrayNextAndCurrentTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/array_next_and_current.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('1', $this->output);
        $this->assertStringContainsString('2', $this->output);
        $this->assertStringContainsString('3', $this->output);
        $this->assertStringContainsString('4', $this->output);
        $this->assertStringContainsString('5', $this->output);
        $this->assertStringContainsString('6', $this->output);

    }
}