<?php

if( !@($GLOBALS["___mysqli_ston"] = mysqli_connect( 'localhost',  'root',  'root')) ) {
    echo 'Inside if';
}
$pass = '123';
$pass = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ?
            mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $pass )
          : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ?
            "" : ""));
echo 'Do we get here?';