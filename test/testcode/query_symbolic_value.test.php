<?php

function PMA_getHashedPassword($password)
{
    $conn = mysqli_connect('localhost:3306',  'root',  'root');
    $result = $conn->query(
        "SELECT PASSWORD('" . $password . "') AS `password`;"
    );

    $hashedPassword = $result['password'];

    return $hashedPassword;
}

$hashedPassword = PMA_getHashedPassword($_POST['pma_pw']);
echo $hashedPassword;