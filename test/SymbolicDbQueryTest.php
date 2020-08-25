<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SymbolicDbQueryTest extends AbstractTest {
    public function test() {
        $filename = 'mysqli.test.php';
        $method = 'POST';
        $this->runScript($filename, $method);
        $this->assertTrue(in_array(10, $this->getForkedLines($filename)));
    }
}