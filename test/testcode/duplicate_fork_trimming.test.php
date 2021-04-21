<?php

function _getMenu()
{
    $allowedTabs = $_POST['allowedTabs'];
    $tabs = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n'];

    foreach ($tabs as $key => $value) {
        if (!array_key_exists($key, $allowedTabs)) {
            unset($tabs[$key]);
        }
    }
    getHtmlTabs($tabs);
}

function getHtmlTabs($tabs) {
    foreach($tabs as $tab) {
        echo '<div>' . $tab . '</div>';
    }
}

_getMenu();