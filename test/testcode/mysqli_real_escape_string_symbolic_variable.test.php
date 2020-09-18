<?php

function escapeString($str)
{
    return mysqli_real_escape_string($str);
}

echo escapeString($_POST['pma_pw']);