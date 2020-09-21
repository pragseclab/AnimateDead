<?php
$conn = mysqli_connect('localhost:3306',  'root',  'root');
$query = ("SELECT table_schema, table_name, create_time
				FROM information_schema.tables
				WHERE table_schema='dvwa' AND table_name='users'
				LIMIT 1");
$result = @mysqli_query($conn,  $query );
if( mysqli_num_rows( $result ) != 1 ) {
    echo 'Need to run setup.php'.PHP_EOL;
}
$query  = "SELECT * FROM `users` WHERE user='user' AND password='1234';";
$result = @mysqli_query($conn,  $query );
if( $result && mysqli_num_rows( $result ) == 1 ) {
    // Login Successful...
    echo "You have logged in as 'user'".PHP_EOL;
}
else {
    // Login failed
    echo 'Login failed'.PHP_EOL;
}