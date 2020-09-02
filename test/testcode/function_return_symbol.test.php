<?php

function getCache()
{
    $a = 'key';
    if ($a && $_COOKIE['PHPIDS'][$a]) {
        return $_COOKIE['PHPIDS'][$a];
    }
    return false;
}

if (getCache()) {
    echo 'True'.PHP_EOL;
}
else {
    echo 'False'.PHP_EOL;
}