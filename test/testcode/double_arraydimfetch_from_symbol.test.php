<?php

$GLOBALS['cfg'] = $_POST['cfg'];
if(isset($GLOBALS['cfg']['Server']['user'])) {
    echo 'is set';
}
else {
    echo 'is not set';
}