<?php

namespace A\A;

class B {
    public function __construct($line_number) {
        echo sprintf('[%d] Creating object of type B in namespace of A\A'.PHP_EOL, $line_number);
    }

    public static function foo($line_number) {
        echo sprintf('[%d] Calling static function foo in class B in namespace A\A'.PHP_EOL, $line_number);
    }
}

function foo($line_number) {
    echo sprintf('[%d] Calling foo in namespace A\A'.PHP_EOL, $line_number);
}