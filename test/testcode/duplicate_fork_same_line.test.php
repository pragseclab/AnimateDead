<?php

function getCookie()
{
    if(isset($_COOKIE['a'])) {
        return 'a';
    }
    else {
        return 'b';
    }
    if (isset($_COOKIE['b'])) {
        return 'c';
    }
    else {
        return 'd';
    }
}

echo getCookie();

$a = 1;

echo getCookie();