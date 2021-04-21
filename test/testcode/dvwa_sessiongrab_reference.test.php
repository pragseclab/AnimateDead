<?php

dvwaPageStartup( array( 'authenticated', 'phpids' ) );
echo 'We should get here';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );
echo 'We should also get here';

function dvwaPageStartup( $pActions ) {
    if( in_array( 'authenticated', $pActions ) ) {
        if( !dvwaIsLoggedIn()) {
            dvwaRedirect( DVWA_WEB_PAGE_TO_ROOT . 'login.php' );
        }
    }

    if( in_array( 'phpids', $pActions ) ) {
        if( dvwaPhpIdsIsEnabled() ) {
            dvwaPhpIdsTrap();
        }
    }
}

function dvwaIsLoggedIn() {
    $dvwaSession =& dvwaSessionGrab();
    return isset( $dvwaSession[ 'username' ] );
}

function dvwaRedirect( $pLocation ) {
    session_commit();
    header( "Location: {$pLocation}" );
    exit;
}

function dvwaPhpIdsIsEnabled() {
    $dvwaSession =& dvwaSessionGrab();
    return isset( $dvwaSession[ 'php_ids' ] );
}

function dvwaPhpIdsTrap() {
    echo "dvwaPhpIdsTrap() called";
}

function &dvwaSessionGrab() {
    if( !isset( $_SESSION[ 'dvwa' ] ) ) {
        $_SESSION[ 'dvwa' ] = array();
    }
    return $_SESSION[ 'dvwa' ];
}