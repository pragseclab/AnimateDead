<?php

$child_pid = pcntl_fork();

if ($child_pid === 0) {
	echo 'in child'.PHP_EOL;
}
else {
	$pid = pcntl_waitpid($child_pid, $status);
	echo 'in parent '.$pid.PHP_EOL;
}
$a = 1;
echo $a;
