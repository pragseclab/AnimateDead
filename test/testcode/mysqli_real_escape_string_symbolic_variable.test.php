<?php

public function escapeString($link, $str)
{
    return mysqli_real_escape_string($link, $str);
}

escapeString($_POST['pma_pw']);