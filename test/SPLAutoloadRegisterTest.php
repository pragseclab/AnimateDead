<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SPLAutoloadRegisterTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/spl_autoload_register.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $tmp = $this->output;
    }
}