<?php

$response = json_decode($_POST['u2f_authentication_response']);
if (is_null($response)) {
	echo "If the response is null";
}
else{
	echo "Json Decoded  Response";
}

//checks if json_decode is covered.
//libraries/classes/Plugins/TwoFactor/Key.php
?>
