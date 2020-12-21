<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SwitchCaseSymbolicTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/switch_case_symbolic.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('vulnerabilities/brute/source/low.php', $this->output);
        $this->assertStringContainsString('vulnerabilities/brute/source/medium.php', $this->output);
        $this->assertStringContainsString('vulnerabilities/brute/source/high.php', $this->output);
        $this->assertStringContainsString('vulnerabilities/brute/source/impossible.php', $this->output);
    }
}