<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class DoWhileSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/do_while_symbol.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('While code executed 1 time(s).', $this->output);
        $this->assertStringContainsString('While code executed 2 time(s).', $this->output);
    }
}