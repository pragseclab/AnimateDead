<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class DuplicateForkTrimmingTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/duplicate_fork_trimming.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('a', $this->output);
    }
}