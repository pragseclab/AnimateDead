<?php

$special_message = '[br]'  . sprintf(
    __('Bookmark %s has been created.'),
    htmlspecialchars($_POST['bkm_label'])
);