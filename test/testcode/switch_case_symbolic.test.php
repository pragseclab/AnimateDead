<?php

switch( $_COOKIE[ 'security' ] ) {
    case 'low':
        $vulnerabilityFile = 'low.php';
        break;
    case 'medium':
        $vulnerabilityFile = 'medium.php';
        break;
    case 'high':
        $vulnerabilityFile = 'high.php';
        break;
    default:
        $vulnerabilityFile = 'impossible.php';
        $method = 'POST';
        break;
}

echo "vulnerabilities/brute/source/{$vulnerabilityFile}".PHP_EOL;