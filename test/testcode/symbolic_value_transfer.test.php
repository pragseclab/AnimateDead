<?php

function copy_value($value) {
    return $value;
}

$username = $_POST['username'];
if ($username === 'admin') {
    echo 'Welcome to the admin panel'.PHP_EOL;
}
else {
    echo 'Please login as admin'.PHP_EOL;
}
$u = $username;
if ($u === 'admin') {
    echo 'Welcome to the admin panel'.PHP_EOL;
}
else {
    echo 'Please login as admin'.PHP_EOL;
}
$copy_u = copy_value($u);
if ($copy_u === 'admin') {
    echo 'Welcome to the admin panel'.PHP_EOL;
}
else {
    echo 'Please login as admin'.PHP_EOL;
}
$concrete_username = 'admin';
if ($concrete_username === 'admin') {
    echo 'Welcome to the admin panel'.PHP_EOL;
}
else {
    echo 'Please login as admin'.PHP_EOL;
}