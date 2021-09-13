<?php

$link = mysqli_connect("localhost", "my_user", "my_password", "world");
$file = mysqli_query($link, "select * from test");

$sym_file = "symbolic_script_inclusion_" . $file . ".test.php";

include $sym_file;