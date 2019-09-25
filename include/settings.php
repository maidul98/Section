<?php
session_start();

//databcase connnection
include 'connection.php';
include 'func.php';

$error = [];
if(isset($_GET["name"])){
  if(strlen($_GET["name"]) > 48){
    $error[] = "Are you sure that is your name?";
  }
  if (strlen($_GET['name']) == 0) {
    $error[] = "No name?";
  }

  if(count($error) == 0){
  $query = "UPDATE users SET name='".mysqli_real_escape_string($mysqli, $_GET['name'])."' WHERE id='".$_SESSION['id']."'";
  $run = mysqli_query($mysqli, $query);
  header("Location: ../settings.php");
  }
}


?>
