<?php
$myfile = fopen("readfiletext.txt", "r") or die("Unable to open file!");
fclose($myfile);


//readfiletext exists; file should be opened in read mode.
?>