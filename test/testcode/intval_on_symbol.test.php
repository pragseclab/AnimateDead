<?php

$original_skip = $skip = intval($_POST['skip']);
while ($skip > 0 && ! $finished) {
    PMA_importGetNextChunk($skip < $read_limit ? $skip : $read_limit);
    // Disable read progressivity, otherwise we eat all memory!
    $read_multiply = 1;
    $skip -= $read_limit;
}