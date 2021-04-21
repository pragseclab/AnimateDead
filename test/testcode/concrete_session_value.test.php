<?php

$_SESSION['ThemeDefault'] = 'original';
if ($_SESSION['ThemeDefault'] === 'original') {
    echo 'SESSION[ThemeDefault] is set to original'.PHP_EOL;
}
else {
    echo 'SESSION[ThemeDefault] is not set to original'.PHP_EOL;
}

if ($_SESSION['UndefinedKey'] === 'somevalue') {
    echo 'SESSION[UndefinedKey] is set to somevalue'.PHP_EOL;
}
else {
    echo 'SESSION[UndefinedKey] is not set to somevalue'.PHP_EOL;
}

$_COOKIE['ThemeDefault'] = 'original';
if ($_COOKIE['ThemeDefault'] === 'original') {
    echo 'COOKIE[ThemeDefault] is set to original'.PHP_EOL;
}
else {
    echo 'COOKIE[ThemeDefault] is not set to original'.PHP_EOL;
}

if ($_COOKIE['UndefinedKey'] === 'somevalue') {
    echo 'COOKIE[UndefinedKey] is set to somevalue'.PHP_EOL;
}
else {
    echo 'COOKIE[UndefinedKey] is not set to somevalue'.PHP_EOL;
}

// function get_current_theme() {
//     if (!isset($_SESSION['ThemeDefault'])) {
//         $_SESSION['ThemeDefault'] = 'original';
//     }
//     return $_SESSION['ThemeDefault'];
// }
// $_SESSION['ThemeDefault'] = 'original';
// // $_SESSION['UndefinedKey'] === SymbolicVariable
// $current_theme = get_current_theme();
// echo $current_theme;
// echo PHP_EOL;
// echo 'Session[ThemeDefault] is only set to "original" past this point'.PHP_EOL;
// $current_theme = get_current_theme();
// echo $current_theme;
// echo PHP_EOL;