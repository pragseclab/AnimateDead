<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class ArrayDimFetchFromGETTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/array_dim_fetch_from_get.test.php';
        $method = 'GET';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringNotContainsString('Must not enter here', $this->output);
    }
}