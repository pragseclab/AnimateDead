<?php
if (isset ($_POST['include'])) {
$page[ 'body' ] .= "
	" . $_POST['include'] . "
";
}

///web/DVWA/vulnerabilities/csp/source/medium.php
//Execution Order: 2,3,4 -> Testing basic post method