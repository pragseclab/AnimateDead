<?php

$cfg = [];
$cfg['Export/method'] = 'key with slash';
$cfg['Test'] = 'key without slash';
$matched_keys = array_filter(
    array_keys($cfg),
    function ($key) {return strpos($key, '/') === false;}
);
foreach ($matched_keys as $key) {
    echo $cfg[$key].PHP_EOL;
}