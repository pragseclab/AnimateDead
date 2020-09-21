<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SetCookieToSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/setcookie_to_symbol.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        // Cookies are symbolic so even setting them to "1" will result in a symbol
        $this->assertStringContainsString('Symbolic', $this->output);
    }
}