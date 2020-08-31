<?php

function test_symbolic_function($a, $b, $c) {
    if ($a === $b) {
        return $c;
    }
    else {
        return false;
    }
}

$a = 1;
$b = 2;
$c = 3;

$d = test_symbolic_function($a, $b, $c);

if ($d === 3) {
    echo 'Test was succesful'.PHP_EOL;
}
else {
    echo 'Test was unsuccesful'.PHP_EOL;
}
if (phpversion() > 5) {
    echo 'Running PHP > 5'.PHP_EOL;
}
else {
    echo 'Running PHP <= 5'.PHP_EOL;
}