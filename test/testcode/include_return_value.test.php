<?php

function getSource()
{
    return 'config.inc.php';
}

$eval_result = include getSource();

if ($eval_result === false) {
    echo 'Errors in config file'.PHP_EOL;
}
else {
    echo 'No errors in config file'.PHP_EOL;
}