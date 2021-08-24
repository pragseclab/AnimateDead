<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ServerRemoteAddrTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/server_remote_addr.test.php';
        $method = 'GET';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('REMOTE_ADDR Matched', $this->output);
    }
}