<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SymbolicIsFileTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/is_file.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('symbolic_inclusion/symbolic_script_inclusion_1.test.php is a file', $this->output);
        $this->assertStringNotContainsString('symbolic_inclusion/symbolic_script_inclusion_1.test.php is not a file', $this->output);
        $this->assertStringContainsString('non_existing/symbolic_*.test.php is not a file', $this->output);
    }
}