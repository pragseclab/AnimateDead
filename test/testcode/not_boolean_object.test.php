<?php
$event = (object) array( 'hook' => 1, 'timestamp' => 2, 'schedule' => false );

if (!$event)
{
    echo "event is not an object";
}
else
{
    echo "event is an object - first try";
}

$event = array( 'hook' => 1, 'timestamp' => 2, 'schedule' => false );

if (!$event)
{
    echo "event is not an object";
}
else
{
    echo "event is an object - second try";
}
