<?php
$myfile = fopen("readfiletext.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("readfiletext.txt"));
fclose($myfile);


//Reading the contents of the file and printing it 
?>