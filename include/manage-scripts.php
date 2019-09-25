<?php
session_start();
//databcase connnection
include 'connection.php';
//update class name
  if(isset($_GET['update-class-name'])){
    $query = "UPDATE classes SET class_title = '".mysqli_real_escape_string($mysqli, $_GET['update-class-name'])."' WHERE id='".$_GET['class-id']."'";
    $run = mysqli_query($mysqli, $query);
    header("Location: \manage-class.php?class=".$_GET['class-id'].""); /* Redirect browser */
  }

?>
