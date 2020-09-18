<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ForSymbolicIteratorTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/for_symbolic_iterator.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(4, $this->getCoveredLines($filename)));
        $this->assertStringContainsString('Iteration: 0', $this->output);
        $this->assertStringContainsString('Iteration: 1', $this->output);
    }
}