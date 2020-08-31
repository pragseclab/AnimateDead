<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SymbolicDbQueryTest extends AbstractTestClass {
    public function test() {
        $filename = './test/testcode/symbolic_dbquery.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(9, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(15, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(19, $this->getCoveredLines($filename)));
    }
}