<?php
if (preg_match('/^[0-9.]+(px|em|pt|\%)$/', $_POST['set_fontsize'])) {
	echo "A match was found";
}

//Testcase to check preg_match 
//index.php
?>
