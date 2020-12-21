<?php

setcookie('theme', 'pma_theme');

// $_COOKIE['theme'] = 'pma_theme';

if (isset($_COOKIE['theme'])) {
    echo 'Cookie is concrete'.PHP_EOL;
}
else {
    echo 'Cookie is symbolic'.PHP_EOL;
}