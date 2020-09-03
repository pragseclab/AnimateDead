<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SetCookieToSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/setcookie_to_symbol.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertTrue(in_array(5, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(9, $this->getCoveredLines($filename)));
        $this->assertStringContainsString('Symbolic', $this->output);
    }
}