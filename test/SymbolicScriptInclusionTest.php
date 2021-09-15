<?php
// rasoul
namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SymbolicScriptInclusionTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/symbolic_script_inclusion.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        // Main worker runs the last included file
        $this->assertStringContainsString('second inclusion', $this->output);
        // Regex should not match third inclusion
        $this->assertStringNotContainsString('third inclusion', $this->output);
    }
}