<?php
$host = '127.0.0.1';

$db_name = 'maidul';

$db_pass = '';

$db_username = 'root';


$mysqli = mysqli_connect($host, $db_username, $db_pass, $db_name);

//check if connection works
if(mysqli_connect_errno()){
  die('Could not connect');
}


?>
