<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
    $id = $_POST[ 'id' ];
    $getid  = "SELECT first_name, last_name FROM users WHERE user_id = $id;";
    $db = $conn = mysqli_connect('localhost:3306',  'root',  'root');
    $result = mysqli_query($db,  $getid); // Removed 'or die' to suppress mysql errors
    $num = @mysqli_num_rows( $result ); // The '@' character suppresses errors
    if($num > 0) {
        echo'User ID exists in the database';
    }
    else {
        echo'User ID is MISSING from the database';
    }
}