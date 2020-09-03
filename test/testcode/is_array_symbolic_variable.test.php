<?php
$key = 'user_id';
$post_values = is_array($_POST[$key])
    ? 'is array'.PHP_EOL
    : 'is not array'.PHP_EOL;
print_r($post_values);