<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ClosureBindTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/closure_bind.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $a = $this->output;
    }
}