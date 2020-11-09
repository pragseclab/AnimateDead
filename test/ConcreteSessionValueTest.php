<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ConcreteSessionValueTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/concrete_session_value.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('SESSION[ThemeDefault] is set to original', $this->output);
        $this->assertStringNotContainsString('SESSION[ThemeDefault] is not set to original', $this->output);
        $this->assertStringContainsString('SESSION[ThemeDefault] is set to somevalue', $this->output);
        $this->assertStringContainsString('SESSION[ThemeDefault] is not set to somevalue', $this->output);

        $this->assertStringContainsString('COOKIE[ThemeDefault] is set to original', $this->output);
        $this->assertStringNotContainsString('COOKIE[ThemeDefault] is not set to original', $this->output);
        $this->assertStringContainsString('COOKIE[ThemeDefault] is set to somevalue', $this->output);
        $this->assertStringContainsString('COOKIE[ThemeDefault] is not set to somevalue', $this->output);
    }
}