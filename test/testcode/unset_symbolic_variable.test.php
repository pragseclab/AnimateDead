<?php

function checkSavedErrors()
{
    if (isset($_SESSION['errors'])) {
        echo '1';
        // delete stored errors
        $_SESSION['errors'] = array();
        unset($_SESSION['errors']);
    }
}

checkSavedErrors();
checkSavedErrors();