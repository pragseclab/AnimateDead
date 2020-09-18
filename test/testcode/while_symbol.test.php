<?php

$original_skip = $skip = intval($_POST['skip']);
$i = 0;
while ($skip > 0) {
    $i++;
    echo sprintf('While code executed %d time(s).'.PHP_EOL, $i);
}