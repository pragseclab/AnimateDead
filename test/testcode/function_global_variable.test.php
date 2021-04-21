<?php

$DBMS = 'MySQL';

function dvwaDatabaseConnect() {
    global $_DVWA;
    global $DBMS;
    // global $DBMS_connError;
    global $db;

    if( $DBMS == 'MySQL' ) {
        if( !@($GLOBALS["___mysqli_ston"] = mysqli_connect( $_DVWA[ 'db_server' ],  $_DVWA[ 'db_user' ],  $_DVWA[ 'db_password' ] ))
            || !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $_DVWA[ 'db_database' ])) ) {
            //die( $DBMS_connError );
            echo 'Unable to connect to the database.<br />';
        }
        // MySQL PDO Prepared Statements (for impossible levels)
        $db = new PDO('mysql:host=localhost');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    elseif( $DBMS == 'PGSQL' ) {
        //$dbconn = pg_connect("host={$_DVWA[ 'db_server' ]} dbname={$_DVWA[ 'db_database' ]} user={$_DVWA[ 'db_user' ]} password={$_DVWA[ 'db_password' ])}"
        //or die( $DBMS_connError );
        echo 'PostgreSQL is not yet fully supported.';
    }
    else {
        die ( "Unknown {$DBMS} selected." );
    }
}
dvwaDatabaseConnect();
$data = $db->prepare( 'SELECT failed_login, last_login FROM users WHERE user = (:user) LIMIT 1;' );
$user = $_POST[ 'username' ];
$data->bindParam( ':user', $user, PDO::PARAM_STR );
$data->execute();
$row = $data->fetch();