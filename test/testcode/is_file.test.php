<?php

// Test Symbolic var matching files on FS
$var1 = 'symbolic_';
$symbolic_str = 'symbolic_inclusion/' . $var1 . $_POST['filename'] . '.test.php';
if (is_file($symbolic_str)) {
    echo $symbolic_str . ' is a file' . PHP_EOL;
}
else {
    echo $symbolic_str . ' is a not file' . PHP_EOL;
}
// Test Symbolic var not matching files on FS
$symbolic_str2 = 'non_existing/' . $var1 . $_POST['filename'] . '.test.php';
if (is_file($symbolic_str2)) {
    echo $symbolic_str2 . ' is a file' . PHP_EOL;
}
else {
    echo $symbolic_str2 . ' is not a file' . PHP_EOL;
}