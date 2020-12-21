<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class UnsetKeySymbolicArrayTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/unset_key_symbolic_array.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        // Cookies are symbolic so even setting them to "1" will result in a symbol
        $this->assertTrue(in_array(8, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(11, $this->getCoveredLines($filename)));
        $this->assertFalse(in_array(14, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(17, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(20, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(23, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(26, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(29, $this->getCoveredLines($filename)));
    }
}