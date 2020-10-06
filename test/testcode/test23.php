<?php
$myfile = fopen("cannotreadfiletext.txt", "r") or die("Unable to open file!");
fclose($myfile);


//cannotreadfiletext does not exist; Unable to open file will get executed;
?>