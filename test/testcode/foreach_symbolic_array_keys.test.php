<?php

$format = 'sql';
$post_patterns = array('/^force_file_/', '/^' . $format . '_/');
$i = 0;
foreach (array_keys($_POST) as $post_key) {
    foreach ($post_patterns as $one_post_pattern) {
        if (preg_match($one_post_pattern, $post_key)) {
            $i++;
            echo 'Iteration: '.$i.PHP_EOL;
            $GLOBALS[$post_key] = $_POST[$post_key];
        }
    }
}