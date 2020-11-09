<?php

namespace C;

class E {
    public function __construct($line_number) {
        echo sprintf('[%d] Creating object of type E in namespace of C'.PHP_EOL, $line_number);
    }

    public static function foo($line_number) {
        echo sprintf('[%d] Calling static function foo in class E in namespace C'.PHP_EOL, $line_number);
    }
}

function foo($line_number) {
    echo sprintf('[%d] Calling foo in namespace C'.PHP_EOL, $line_number);
}