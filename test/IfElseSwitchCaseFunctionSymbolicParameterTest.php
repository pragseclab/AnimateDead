<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IfElseSwitchCaseFunctionSymbolicParameterTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/if_else_switch_case_function_symbolic_parameter.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('ids: ids,were,valid', $this->output);
        $this->assertStringContainsString('vids: ids', $this->output);
        $this->assertStringContainsString('vals: vals were valid', $this->output);
    }
}