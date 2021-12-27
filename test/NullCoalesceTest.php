<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class NullCoalesceTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/null_coalesce.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('a is 1', $this->output);
        $this->assertStringContainsString('a is 2', $this->output);
        $this->assertArrayHasKey(13, $this->getForkedLines(realpath($filename)));
    }
}