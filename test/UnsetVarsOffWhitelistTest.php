<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class UnsetVarsOffWhitelistTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/unset_vars_off_whitelist.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('a is unset', $this->output);
        $this->assertStringContainsString('b is set', $this->output);
    }
}