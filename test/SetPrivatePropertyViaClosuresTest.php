<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SetPrivatePropertyViaClosuresTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/set_private_property_via_closures.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $tmp = $this->output;
    }
}