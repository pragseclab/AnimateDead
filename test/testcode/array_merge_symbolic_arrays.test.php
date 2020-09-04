<?php

$keys = array_keys(
    array_merge((array)$_REQUEST, (array)$_GET, (array)$_POST, (array)$_COOKIE)
);
if (sizeof($keys) > 0) {
    echo 'There are keys'.PHP_EOL;
}
else {
    echo 'There are no keys'.PHP_EOL;
}