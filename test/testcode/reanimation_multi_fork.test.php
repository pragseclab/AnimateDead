<?php

for ($i = 0; $i < 5; $i++) {
    if ($_COOKIE['a'] < 5) {
        $a = 2;
        echo 'inside for loop\n';
    }
}
if (isset($_POST['b'])) {
    echo 'inside if _SESSION[\'b\']\n';
    if (isset($_POST['c'])) {
        echo 'inside if _SESSION[\'c\']\n';
    }
}
echo 'outside ifs\n';