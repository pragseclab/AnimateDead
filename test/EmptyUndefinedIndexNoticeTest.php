<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class EmptyUndefinedIndexNoticeTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/empty_undefined_index_notice.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('is empty', $this->output);
    }
}