<?php

if (empty($_COOKIE['pma_lang']) && ! empty($GLOBALS['lang'])) {
    echo 'inside if'.PHP_EOL;
}
else {
    echo 'outside if'.PHP_EOL;
}