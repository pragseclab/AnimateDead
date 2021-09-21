<?php

$anonymous_obj = (object) array( 'hook' => 1, 'timestamp' => 2, 'schedule' => false );

if ($anonymous_obj)
{
    echo "anonymous_obj conditional is true".PHP_EOL;
}
if (!$anonymous_obj)
{
    echo "anonymous_obj conditional is false".PHP_EOL;
}

$dir_class = dir('.');
if ($dir_class)
{
    echo 'dir_class conditional is true'.PHP_EOL;
}

$dir_class2 = dir('non_existing_dir');

if (!$dir_class2)
{
    echo "dir_class2 conditional is false".PHP_EOL;
}