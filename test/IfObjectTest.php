<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IfObjectTest extends AbstractTestClass
{
    public function test()
    {
        // Path from root of application
        $filename = './test/testcode/if_object.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('anonymous_obj conditional is true', $this->output);
        $this->assertStringContainsString('dir_class conditional is true', $this->output);
        $this->assertStringContainsString('dir_class2 conditional is false', $this->output);
    }
}