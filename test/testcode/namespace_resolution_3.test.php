<?php

namespace B;

class D {
    public function __construct($line_number) {
        echo sprintf('[%d] Creating object of type D in namespace of B'.PHP_EOL, $line_number);
    }

    public static function foo($line_number) {
        echo sprintf('[%d] Calling static function foo in class D in namespace B'.PHP_EOL, $line_number);
    }
}

function foo($line_number) {
    echo sprintf('[%d] Calling foo in namespace B'.PHP_EOL, $line_number);
}