<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class DVWASessionGrabReferenceTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/dvwa_sessiongrab_reference.test.php';
        $method = 'GET';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(4, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(7, $this->getCoveredLines($filename)));
    }
}