<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class PropertySetParentClassTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/property_set_parent_class.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $fork_info = $this->getForkInfo();
        $forked_lines = array_pop($fork_info);
        $this->assertTrue(isset($forked_lines[17]));
    }
}