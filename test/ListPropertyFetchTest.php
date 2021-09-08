<?php
// rasoul
namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ListPropertyFetchTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/list_property_fetch.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('this is a list - first property fetch', $this->output);
        $this->assertStringContainsString('', $this->output);
    }
}