<?php

function __($str) {
    // Can be used for internationalization
    return $str;
}

$special_message = '[br]'  . sprintf(
    __('Bookmark %s has been created.'),
    htmlspecialchars($_POST['bkm_label'])
);
echo $special_message;