<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class DVWAMessagePushTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/dvwaMessagePush.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('SymbolicVariable for $arr[', $this->output);
    }
}