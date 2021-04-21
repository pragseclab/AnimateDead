<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class DuplicateForkSameLineTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/duplicate_fork_same_line.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(5, $this->getForkedLines($filename)));
        $this->assertTrue(in_array(11, $this->getForkedLines($filename)));
    }
}