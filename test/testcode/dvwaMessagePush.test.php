<?php

function &dvwaSessionGrab() {
    if( !isset( $_SESSION[ 'dvwa' ] ) ) {
        $_SESSION[ 'dvwa' ] = array();
    }
    return $_SESSION[ 'dvwa' ];
}

function dvwaMessagePush( $pMessage ) {
    $dvwaSession =& dvwaSessionGrab();
    if( !isset( $dvwaSession[ 'messages' ] ) ) {
        $dvwaSession[ 'messages' ] = array();
    }
    $dvwaSession[ 'messages' ][] = $pMessage;
}

if ($_POST['a']) {
    dvwaMessagePush( 'Unable to connect to the database.<br />' . $DBMS_errorFunc );
    dvwaMessagePush( 'Unable to connect to the database.<br />' . $DBMS_errorFunc );
}