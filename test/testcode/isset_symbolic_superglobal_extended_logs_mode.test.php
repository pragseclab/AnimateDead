<?php

if (!isset($_POST['not_set_param'])) {
    echo '_POST["not_set_param"] is not set';
}
else {
    echo '_POST["not_set_param"] is set';
}
if (!isset($_POST['set_param'])) {
    echo '_POST["set_param"] is not set';
}
else {
    echo '_POST["set_param"] is set';
}
if (empty($_COOKIE['ck'])) {
    echo '_COOKIE["ck"] is empty';
}