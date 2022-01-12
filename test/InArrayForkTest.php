<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class InArrayForkTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/in_array_fork.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('wp_ajax_oembed-cache wp_ajax_oembed_cache', $this->output);
        $this->assertStringNotContainsString('fetch-list', $this->output);
    }
}