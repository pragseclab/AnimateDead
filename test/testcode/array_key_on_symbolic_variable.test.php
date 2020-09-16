<?php

// if a subform is present and should be used
// the rest of the form is deprecated
$subform_id = key($_POST['usesubform']);
$subform    = $_POST['subform'][$subform_id];
$_POST      = $subform;
$_REQUEST   = $subform;
if ($_POST) {
    echo 'This should execute for $_POST'.PHP_EOL;
}
else {
    echo 'This should also execute for $_POST'.PHP_EOL;
}
if ($_REQUEST) {
    echo 'This should execute for $_REQUEST'.PHP_EOL;
}
else {
    echo 'This should also execute for $_REQUEST'.PHP_EOL;
}