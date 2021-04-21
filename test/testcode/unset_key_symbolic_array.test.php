<?php
$_REQUEST['goto'] = 'request_goto';
$_GET['goto'] = 'get_goto';
$_POST['goto'] = 'post_goto';
$_COOKIE['goto'] = 'cookie_goto';
unset($_REQUEST['goto'], $_GET['goto'], $_POST['goto'], $_COOKIE['goto']);
if (isset($_REQUEST['goto'])) {
    echo 'Request is set'.PHP_EOL;
}
else {
    echo 'Request is not set'.PHP_EOL;
}
if (isset($_GET['goto'])) {
    echo 'Get is set'.PHP_EOL;
}
else {
    echo 'Get is not set'.PHP_EOL;
}
if (isset($_POST['goto'])) {
    echo 'Post is set'.PHP_EOL;
}
else {
    echo 'Post is not set'.PHP_EOL;
}
if (isset($_COOKIE['goto'])) {
    echo 'Cookie is set'.PHP_EOL;
}
else {
    echo 'Cookie is not set'.PHP_EOL;
}