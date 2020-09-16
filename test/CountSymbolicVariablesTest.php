<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class CountSymbolicVariablesTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/count_symbolic_variables.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $a = $this->output;
        $this->assertStringContainsString('count(GET) and count(POST) are 0.', $this->output);
        $this->assertStringContainsString('<form action="openid.php"', $this->output);
    }
}