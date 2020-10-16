<?php
$a = 1;
$b = 2;
$variables_whitelist = array (
    'GLOBALS',
    '_SERVER',
    '_GET',
    '_POST',
    '_REQUEST',
    '_FILES',
    '_ENV',
    '_COOKIE',
    '_SESSION',
    'error_handler',
    'PMA_PHP_SELF',
    'variables_whitelist',
    'key',
    'b'
);

foreach (get_defined_vars() as $key => $value) {
    if (! in_array($key, $variables_whitelist)) {
        unset($$key);
    }
}

if(isset($a)) {
    echo 'a is set'.PHP_EOL;
}
else {
    echo 'a is unset'.PHP_EOL;
}
if(isset($b)) {
    echo 'b is set'.PHP_EOL;
}
else {
    echo 'b is unset'.PHP_EOL;
}