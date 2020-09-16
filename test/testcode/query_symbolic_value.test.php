<?php

$hashedPassword = PMA_getHashedPassword($_POST['pma_pw']);
function PMA_getHashedPassword($password)
{
    $result = $GLOBALS['dbi']->fetchSingleRow(
        "SELECT PASSWORD('" . $password . "') AS `password`;"
    );

    $hashedPassword = $result['password'];

    return $hashedPassword;
}