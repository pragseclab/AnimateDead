<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ForeachSymbolicKeyvarTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/foreach_symbolic_keyvar.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('Remove cookie:', $this->output);
        $this->assertStringContainsString('Keep cookie:', $this->output);
    }
}