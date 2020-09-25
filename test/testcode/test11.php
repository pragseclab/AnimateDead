<?php

$db = isset($_POST['db']) ? $_POST['db'] : $GLOBALS['db'];
if($db){
	echo "It was initialized";
}
else {
	echo "Not initialized";
}


//Testcase to check Ternary Operator(?:)
//db_sql_autocomplete.php
?>