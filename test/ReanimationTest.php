<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ReanimationTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/array_key_on_symbolic_variable.test.php';
        $method = 'POST';
        // Enable reanimation mdoe
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json', 534);
        $this->assertFalse(in_array(10, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(13, $this->getCoveredLines($filename)));
        $this->assertFalse(in_array(16, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(19, $this->getCoveredLines($filename)));
    }
}