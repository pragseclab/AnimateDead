<?php

global $test;
$test = 1;

function foo () {
    global $test;
    echo $test."\n";
    $test += 1;


}

function bar () {
    global $test;
    echo $test."\n";
    $test += 1;
}

function baz () {
    global $test;
    echo $test."\n";
    $test += 1;
}
$cond = array(false, true, true);
$funcs = array ('foo','bar','baz');

do {
    $check = $tmp = current($cond);
    if ($check) {
        foreach ($funcs as $the_) {
            call_user_func($the_);
        }
    }
} while (next($cond));
