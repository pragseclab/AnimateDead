<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class RemoveRequestVarsTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/remove_request_vars.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('allowed POST variable', $this->output);
        $this->assertStringNotContainsString('disallowed POST variable', $this->output);
        $this->assertStringContainsString('allowed COOKIE variable', $this->output);
        $this->assertStringNotContainsString('disallowed COOKIE variable', $this->output);
        $this->assertStringContainsString('allowed GET variable', $this->output);
        $this->assertStringNotContainsString('disallowed GET variable', $this->output);
        $this->assertStringContainsString('allowed REQUEST variable', $this->output);
        $this->assertStringNotContainsString('disallowed REQUEST variable', $this->output);
    }
}