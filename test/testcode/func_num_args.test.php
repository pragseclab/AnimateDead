<?php

function func($a, $b='') {
    return func_num_args();
}

for ($i = 0, $num = func(1, 2, 3); $i < $num; $i++) {
    echo $i;
}