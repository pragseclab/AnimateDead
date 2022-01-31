<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class MagicMethodCodeCoverageTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/magic_method_code_coverage.test.php';
        $method = 'GET';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('public_prop is public_prop', $this->output);
        $this->assertStringNotContainsString('Running __get for protected_prop', $this->output);
        $this->assertStringContainsString('Running __get for private_prop', $this->output);
        $this->assertStringContainsString('protected_prop is protected_prop', $this->output);
        $this->assertStringContainsString('private_prop is private_prop', $this->output);
        $this->assertContains(10, end($this->coverage_info));
    }
}