<?php

function foo($line_number) {
    echo sprintf('[%d] Calling foo in global namespace'.PHP_EOL, $line_number);
}

class F {
    public function __construct($line_number) {
        echo sprintf('[%d] Creating object of type F in global namespace'.PHP_EOL, $line_number);
    }
}

class B {
    public function __construct($line_number) {
        echo sprintf('[%d] Creating object of type B in global namespace'.PHP_EOL, $line_number);
    }

    public static function foo($line_number) {
        echo sprintf('[%d] Calling static function foo in class B in global namespace'.PHP_EOL, $line_number);
    }
}

class D {
    public function __construct($line_number) {
        echo sprintf('[%d] Creating object of type D in global namespace'.PHP_EOL, $line_number);
    }
}

include 'namespace_resolution_1.test.php';