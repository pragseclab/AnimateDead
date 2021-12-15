<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SymbolicRegexStringManipulationTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/symbolic_regex_str_manipulation.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('all uppercase: LIBRARIES/PLUGINS/EXPORT_*.PHP', $this->output);
        $this->assertStringContainsString('all lowercase: libraries/plugins/export_*.php', $this->output);
        $this->assertStringContainsString('str_replace: libraries\\plugins\\Export_*.php', $this->output);
    }
}