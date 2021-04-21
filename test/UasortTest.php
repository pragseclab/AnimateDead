<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class UasortTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/uasort.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $a = $this->output();
    }
}