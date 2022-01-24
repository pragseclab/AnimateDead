<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SwitchCaseNoBreakTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/switch_case_no_break.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('low-med-high.php', $this->output);
        $this->assertStringNotContainsString('1.php', $this->output);
    }
}