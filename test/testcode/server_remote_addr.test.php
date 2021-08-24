<?php

if ($_SERVER['REMOTE_ADDR'] === '172.21.0.1') {
    echo 'REMOTE_ADDR Matched';
}
else {
    echo 'REMOTE_ADDR Unmatched';
}