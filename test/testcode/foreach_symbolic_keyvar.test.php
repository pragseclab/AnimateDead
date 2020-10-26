<?php

foreach ($_COOKIE as $cookie_name => $tmp) {
    // We ignore cookies not with pma prefix
    if (strncmp('pma', $cookie_name, 3) != 0) {
        echo 'Keep cookie: ';
        echo $cookie_name;
        echo PHP_EOL;
        continue;
    }
    echo 'Remove cookie: ';
    echo $cookie_name;
    echo PHP_EOL;
}