<?php
// rasoul
namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ListPropertyFetchTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/symbolic_script_inclusion.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('first inclusion', $this->output);
    }
}