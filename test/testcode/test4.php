<?php

echo 'Including test4.php'.PHP_EOL;

if ($_GET['username'] === 'admin') {
    ....
}
else {
    redirect_to_login();
}