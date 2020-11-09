<?php

function checkFontsize()
{
    $new_fontsize = '';

    if (isset($_GET['set_fontsize'])) {
        echo 'Must not enter here';
        $new_fontsize = $_GET['set_fontsize'];
    }
    else {
        echo 'Running this is fine';
    }
    return $new_fontsize;
}

checkFontsize();