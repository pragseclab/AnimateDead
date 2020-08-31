<?php

$vulnerabilityFile = 'test1.php';
switch( $_COOKIE[ 'security' ] ) {
    case 'low':
        $vulnerabilityFile = 'low';
        // echo $vulnerabilityFile.PHP_EOL;
        break;
    case 'medium':
        $vulnerabilityFile = 'medium.php';
        // echo 'medium'.PHP_EOL;
        break;
    case 'high':
        $vulnerabilityFile = 'high.php';
        // echo 'high'.PHP_EOL;
        break;
    default:
        $vulnerabilityFile = 'impossible.php';
        // echo 'impossible'.PHP_EOL;
        $method = 'POST';
        break;
}
echo "vulnerabilities/brute/source/{$vulnerabilityFile}".PHP_EOL;

----
a
b
c

// echo  "vulnerabilities/brute/source/{$a}".PHP_EOL;
// echo 'Now running the rest of the code'.PHP_EOL;