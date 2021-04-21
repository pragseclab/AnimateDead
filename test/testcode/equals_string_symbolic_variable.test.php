<?php

if (isset($_POST['output_format']) && $_POST['output_format'] == 'sendit') {
    define('PMA_BYPASS_GET_INSTANCE', 1);
}
else {
    echo 'PMA_BYPASS_GET_INSTANCE is undefined'.PHP_EOL;
}