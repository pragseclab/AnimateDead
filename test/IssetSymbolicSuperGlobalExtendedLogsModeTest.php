<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IssetSymbolicSuperGlobalExtendedLogsModeTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/isset_symbolic_superglobal_extended_logs_mode.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, ['_POST' => ['set_param']], './test/config_symbolicvariable.json', null, true);
        $this->assertStringContainsString('_POST["not_set_param"] is not set', $this->output);
        $this->assertStringNotContainsString('_POST["not_set_param"] is set', $this->output);
        $this->assertStringContainsString('_POST["set_param"] is set', $this->output);
        $this->assertStringNotContainsString('_POST["set_param"] is not set', $this->output);

        $fork_info = $this->getForkInfo();
        $forked_lines = array_pop($fork_info);
        $this->assertFalse(isset($forked_lines[3]));
        $this->assertTrue(isset($forked_lines[9]));
    }
}