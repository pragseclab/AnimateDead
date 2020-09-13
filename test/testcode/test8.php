<?php
if( isset( $_POST[ 'Submit' ]  ) ) {
	$id = $_POST[ 'id' ];
	$getid  = "SELECT first_name, last_name FROM users WHERE user_id = $id;";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $getid ); // Removed 'or die' to suppress mysql errors
	$num = @mysqli_num_rows( $result ); // The '@' character suppresses errors
	if($num > 0) {
		echo'User ID exists in the database';
	}
	else {
		echo'User ID is MISSING from the database';
	}
}


//web/DVWA/vulnerabilities/sqli_blind/source/medium.php
//Execution Order: 2,3,4,5,6,7,8,10,11 -> Testing sql query statements
?>