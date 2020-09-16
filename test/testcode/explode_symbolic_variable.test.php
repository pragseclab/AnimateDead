<?php
$_SERVER['REQUEST_URI'] = 'http://localhost/explode_symbolic_variable.test.php?a=1&b=2';
if (!count($_POST)) {
    list(, $queryString) = explode('?', $_SERVER['REQUEST_URI']);
} else {
    // I hate php sometimes
    $queryString = file_get_contents('php://input');
}
if ($queryString) {
    echo 'queryString is true'.PHP_EOL;
}
else {
    echo 'queryString is false'.PHP_EOL;
}