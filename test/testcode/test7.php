<?php
if( isset( $_POST[ 'btnSign' ] ) ) {
	
	$message = trim( $_POST[ 'mtxMessage' ] );
	$name    = trim( $_POST[ 'txtName' ] );

	$data = $db->prepare( 'INSERT INTO guestbook ( comment, name ) VALUES ( :message, :name );' );
	$data->bindParam( ':message', $message, PDO::PARAM_STR );
	$data->bindParam( ':name', $name, PDO::PARAM_STR );
	$data->execute();
}




//web/DVWA/vulnerabilities/xss_s/source/impossible.php

//Execution Order: 2,4,5(Symbolic statements), 7,8,9,10 -> Testing Prepare statement