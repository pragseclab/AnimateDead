<?php

$original_skip = $skip = intval($_POST['skip']);
$i = 0;
do {
    $i++;
    echo sprintf('While code executed %d time(s).'.PHP_EOL, $i);
}
while ($skip > 0);