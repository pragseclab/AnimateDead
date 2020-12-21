<?php

$cfg['Servers'] = [1, 2, 3];

if (isset($_REQUEST['server'])
    && (is_string($_REQUEST['server']) || is_numeric($_REQUEST['server']))
    && ! empty($_REQUEST['server'])
    && ! empty($cfg['Servers'][$_REQUEST['server']])) {
    echo 'Inside if'.PHP_EOL;
} else {
    echo 'Inside else'.PHP_EOL;
}