<?php

$new_fontsize = 'default value';

if (isset($_GET['set_fontsize'])) {
    $new_fontsize = $_GET['set_fontsize'];
} elseif (isset($_POST['set_fontsize'])) {
    $new_fontsize = $_POST['set_fontsize'];
} elseif (isset($_COOKIE['pma_fontsize'])) {
    $new_fontsize = $_COOKIE['pma_fontsize'];
}

echo $new_fontsize;