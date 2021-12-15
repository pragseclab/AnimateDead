<?php

$symbolic_str = 'libraries/plugins/Export_' . $_POST['filetype'] . '.php';
$uppercase_str = mb_strtoupper($symbolic_str);
$lowercase_str = mb_strtolower($symbolic_str);

$str_replace = str_replace('/', '\\', $symbolic_str);

echo 'all uppercase: ' . $uppercase_str . PHP_EOL;
echo 'all lowercase: ' . $lowercase_str . PHP_EOL;
echo 'str_replace: ' . $str_replace . PHP_EOL;
