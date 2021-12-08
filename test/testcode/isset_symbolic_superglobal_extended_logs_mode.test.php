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