<?php

class PrivatePropClass {

}

$var = 'default value';

$closure =  \Closure::bind(function () use (&$var) {
    $var = 'updated inside close';
}, null, PrivatePropClass::class);

call_user_func($closure);