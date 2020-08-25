<?php
// $a = '';
// // $_POST[ 'security' ] = '1';
// if ($_POST[ 'security' ] === '1') {
//     $a = 'test1';
// }
// elseif ($_POST[ 'security' ] === '2') {
//     $a = 'test2';
// }
// elseif ($_POST[ 'security' ] === '3') {
//     $a = 'test3';
// }
// else {
//     $a = 'test4';
// }
// include $a.'.php';

function func1($a, $b, $c) {
    if ($a === $b) {
        echo $a.PHPE_EOL;
    }
}

func1($_REQUEST['user_token'], 'bbbb', 'c');
exit;
$method            = 'GET';
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
echo  "vulnerabilities/brute/source/{$vulnerabilityFile}".PHP_EOL;


// echo  "vulnerabilities/brute/source/{$a}".PHP_EOL;
// echo 'Now running the rest of the code'.PHP_EOL;