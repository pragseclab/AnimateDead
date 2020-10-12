<?php

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

class NamespaceResolutionTest extends AbstractTestClass {
    public function test() {
        // Path from root of application
        $filename = './test/testcode/namespace_resolution.test.php';
        $method = 'POST';
        $this->runScript($filename, $method, [], './test/config_symbolicvariable.json');
        $this->assertStringContainsString('[26] Calling foo in namespace A', $this->output);
        $this->assertStringContainsString('[27] Calling foo in global namespace', $this->output);
        $this->assertStringContainsString('[28] Calling foo in A\my', $this->output);
        $this->assertStringContainsString('[29] Creating object of type B in namespace of A', $this->output);
        $this->assertStringContainsString('[30] Creating object of type D in namespace of B', $this->output);
        $this->assertStringContainsString('[31] Creating object of type E in namespace of C', $this->output);
        $this->assertStringContainsString('[32] Creating object of type B in global namespace', $this->output);
        $this->assertStringContainsString('[33] Creating object of type D in global namespace', $this->output);
        $this->assertStringContainsString('[34] Calling foo in namespace A\A', $this->output);
        $this->assertStringContainsString('[35] Calling static function foo in class B in namespace A', $this->output);
        $this->assertStringContainsString('[36] Calling static function foo in class D in namespace B', $this->output);
        $this->assertStringContainsString('[37] Calling foo in namespace B', $this->output);
        $this->assertStringContainsString('[38] Calling static function foo in class B in global namespace', $this->output);
        $this->assertStringContainsString('[39] Calling static function foo in class B in namespace A\A', $this->output);
        $this->assertStringContainsString('[40] Calling static function foo in class B in namespace A', $this->output);
    }
}