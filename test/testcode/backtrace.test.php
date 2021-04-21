<?php

function a() {
    echo 'a called'.PHP_EOL;
    $trace = debug_backtrace();
    var_dump($trace);
}
a();