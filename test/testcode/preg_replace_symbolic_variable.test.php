<?php

function PMA_securePath($path)
{
    // change .. to .
    $path = preg_replace('@\.\.*@', '.', $path);

    return $path;
} // end function

$what = PMA_securePath($_POST['what']);
echo $what;