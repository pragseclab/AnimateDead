<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class FuncNumArgsTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/func_num_args.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('2', $this->output);
    }
}