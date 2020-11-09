<?php

function removeRequestVars(&$whitelist)
{
    // do not check only $_REQUEST because it could have been overwritten
    // and use type casting because the variables could have become
    // strings
    if (! isset($_REQUEST)) {
        $_REQUEST = array();
    }
    if (! isset($_GET)) {
        $_GET = array();
    }
    if (! isset($_POST)) {
        $_POST = array();
    }
    if (! isset($_COOKIE)) {
        $_COOKIE = array();
    }
    $keys = array_keys(
        array_merge((array)$_REQUEST, (array)$_GET, (array)$_POST, (array)$_COOKIE)
    );

    foreach ($keys as $key) {
        if (! in_array($key, $whitelist)) {
            unset($_REQUEST[$key], $_GET[$key], $_POST[$key]);
            continue;
        }

        // allowed stuff could be compromised so escape it
        // we require it to be a string
        if (isset($_REQUEST[$key]) && ! is_string($_REQUEST[$key])) {
            unset($_REQUEST[$key]);
        }
        if (isset($_POST[$key]) && ! is_string($_POST[$key])) {
            unset($_POST[$key]);
        }
        if (isset($_COOKIE[$key]) && ! is_string($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
        }
        if (isset($_GET[$key]) && ! is_string($_GET[$key])) {
            unset($_GET[$key]);
        }
    }
}
$whitelist = array('ajax_request');
$_POST['ajax_request'] = 'allowed POST variable';
$_COOKIE['ajax_request'] = 'allowed COOKIE variable';
$_REQUEST['ajax_request'] = 'allowed REQUEST variable';
$_GET['ajax_request'] = 'allowed GET variable';
$_POST['non_ajax_request'] = 'disallowed POST variable';
$_COOKIE['non_ajax_request'] = 'disallowed COOKIE variable';
$_REQUEST['non_ajax_request'] = 'disallowed REQUEST variable';
$_GET['non_ajax_request'] = 'disallowed GET variable';
removeRequestVars($whitelist);
var_dump($_POST);
var_dump($_COOKIE);
var_dump($_REQUEST);
var_dump($_GET);