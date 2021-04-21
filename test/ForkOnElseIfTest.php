<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ForkOnElseIfTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/fork_on_elseif.test.php';
        $method = 'GET';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(3, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(5, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(7, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(9, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(13, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(10, $this->getCoveredLines($filename)));
    }
}