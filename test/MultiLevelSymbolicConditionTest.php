<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class MultiLevelSymbolicConditionTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/multilevel_symbolic_condition.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('Inside if', $this->output);
        $this->assertStringContainsString('Inside else', $this->output);
    }
}