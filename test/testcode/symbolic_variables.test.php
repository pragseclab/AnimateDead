<?php

/* config.json:
 * $_GET is concrete
 * $_POST is symbolic
 * $_REQUEST is symbolic
 * $_COOKIE is symbolic
 */

if (isset($_GET['a'])) {
    echo 'GET is set.'; // Should not run
}
else {
    echo 'GET not set.'; // Should run
}
if (isset($_POST['a'])) {
    echo 'POST is set.'; // Should run
}
else {
    echo 'POST not set.'; // Should run
}
if (isset($_REQUEST['a'])) {
    echo 'REQUEST is set.'; // Should run
}
else {
    echo 'REQUEST not set.'; // Should run
}
if (isset($_COOKIE['a'])) {
    echo 'COOKIE is set.'; // Should run
}
else {
    echo 'COOKIE not set.'; // Should run
}
