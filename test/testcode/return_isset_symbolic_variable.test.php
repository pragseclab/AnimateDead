<?php

while (dvwaIsLoggedIn()) {
    echo 'looping in while'.PHP_EOL;
}
echo 'got outside of while'.PHP_EOL;
function dvwaIsLoggedIn() {
    $dvwaSession =& dvwaSessionGrab();
    return isset( $dvwaSession[ 'username' ] );
}

function &dvwaSessionGrab() {
    if( !isset( $_SESSION[ 'dvwa' ] ) ) {
        $_SESSION[ 'dvwa' ] = array();
    }
    return $_SESSION[ 'dvwa' ];
}