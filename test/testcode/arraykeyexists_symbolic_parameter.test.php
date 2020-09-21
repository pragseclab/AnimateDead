<?php

function checkToken( $user_token, $session_token, $returnURL ) {  # Validate the given (CSRF) token
    if( $user_token !== $session_token || !isset( $session_token ) ) {
        echo 'CSRF token is incorrect'.PHP_EOL;
        dvwaRedirect( $returnURL );
    }
}
function dvwaRedirect( $pLocation ) {
    session_commit();
    header( "Location: {$pLocation}" );
    exit;
}

if (array_key_exists ("session_token", $_POST)) {
    $session_token = $_POST[ 'session_token' ];
} else {
    $session_token = "";
}

checkToken( $_REQUEST[ 'user_token' ], $session_token, 'login.php' );
echo 'CSRF Token was valid'.PHP_EOL;