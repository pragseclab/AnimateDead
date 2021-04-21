<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class AccessUndefinedStaticPropertyTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/access_undefined_static_property.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('self::$loader is null', $this->output);
        $this->assertStringNotContainsString('self::$loader is not null', $this->output);
    }
}