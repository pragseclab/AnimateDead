<?php

if( !@($a = mysqli_connect('localhost:3306', 'root', 'root'))) {
    echo 'fail';
}
else {
    echo 'success';
}