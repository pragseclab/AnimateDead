<?php

$a = 1;

if (is_scalar($a)) {
    echo 'a is scalar'.PHP_EOL;
}

if (is_scalar($_POST['a'])) {
    echo 'POST[a] is scalar'.PHP_EOL;
}
