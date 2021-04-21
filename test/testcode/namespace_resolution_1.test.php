<?php

namespace A;

include 'namespace_resolution_2.test.php';
include 'namespace_resolution_3.test.php';
include 'namespace_resolution_4.test.php';
include 'namespace_resolution_5.test.php';

use B\D, C\E as F;

class B {
    public function __construct($line_number) {
        echo sprintf('[%d] Creating object of type B in namespace of A'.PHP_EOL, $line_number);
    }

    public static function foo($line_number) {
        echo sprintf('[%d] Calling static function foo in class B in namespace A'.PHP_EOL, $line_number);
    }
}

function foo($line_number) {
    echo sprintf('[%d] Calling foo in namespace A'.PHP_EOL, $line_number);
}

foo(26);      // [26] Calling foo in namespace A
\foo(27);     // [27] Calling foo in global namespace
my\foo(28);   // [28] Calling foo in A\my
new B(29);    // [29] Creating object of type B in namespace of A
new D(30);    // [30] Creating object of type D in namespace of B
new F(31);    // [31] Creating object of type E in namespace of C
new \B(32);   // [32] Creating object of type B in global namespace
new \D(33);   // [33] Creating object of type D in global namespace
A\foo(34);    // [34] Calling foo in namespace A\A
B::foo(35);   // [35] Calling static function foo in class B in namespace A
D::foo(36);   // [36] Calling static function foo in class D in namespace B
\B\foo(37);   // [37] Calling foo in namespace B
\B::foo(38);  // [38] Calling static function foo in class B in global namespace
A\B::foo(39); // [39] Calling static function foo in class B in namespace A\A
\A\B::foo(40);// [40] Calling static function foo in class B in namespace A