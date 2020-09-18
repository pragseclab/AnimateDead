<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ForeachSymbolicArrayKeysTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/foreach_symbolic_array_keys.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(8, $this->getCoveredLines($filename)));
        $this->assertStringContainsString('Iteration: 1', $this->output);
        $this->assertStringContainsString('Iteration: 4', $this->output);
    }
}