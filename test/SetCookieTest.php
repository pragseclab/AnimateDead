<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class SetCookieTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/setCookie.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        // Cookies are symbolic so even setting them to "1" will result in a symbol
        $this->assertStringContainsString('concrete', $this->output);
        $this->assertStringNotContainsString('symbolic', $this->output);
    }
}