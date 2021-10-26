<?php

$b = null;
$c = null;
$d = 1;

$a = $b ?? $c ?? $d;

echo 'a is '. $a.PHP_EOL;

$d = 2;

$a = $_POST['test'] ?? $d;

if ($a === 2) {
    echo 'a is 2'.PHP_EOL;
}
else {
    echo 'a is not 2'.PHP_EOL;
}