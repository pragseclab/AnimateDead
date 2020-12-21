<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class StringBasedOnSymbolTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/string_based_on_symbol.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString("<input type='hidden' name='user_token'", $this->output);
        $this->assertTrue(in_array(4, $this->getCoveredLines($filename)));
        $this->assertTrue(in_array(7, $this->getCoveredLines($filename)));
    }
}