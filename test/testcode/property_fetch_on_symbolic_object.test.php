<?php

$conn = mysqli_connect('localhost:3306',  'root',  'root');
if ( $conn->error) {
    echo "There is an error";
} else {
    echo "There is no error";
}
