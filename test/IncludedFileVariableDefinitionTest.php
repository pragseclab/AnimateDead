<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class IncludedFileVariableDefinitionTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/included_file_variable_definition.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('Defined in an included file', $this->output);
    }
}