<?php

$var = 'low';
$target = '';

switch($var) {
    case 'low':
    case 'medium':
    case 'high':
        $target = 'low-med-high.php';
        break;
    case '1':
        $target = '1.php';
}

echo $target . PHP_EOL;