<?php
$table = explode('.', $column);
$table = $table[0];
if ($is_where == 'Y') {
	$very_good[$column] = $table;
} 
else {
	$still_good[$column] = $table;
}

//checks if explode() is covered
//libraries/classes/Database/Qbe.php
?>