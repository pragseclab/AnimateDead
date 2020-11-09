<?php

namespace A\my;

use B\D, C\D as F;


function foo($line_number) {
    echo sprintf('[%d] Calling foo in A\my'.PHP_EOL, $line_number);
}