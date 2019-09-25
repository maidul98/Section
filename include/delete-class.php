<?php
session_start();
//databcase connnection
include 'connection.php';

$errors = array();
if(isset($_POST['password-remove-class'])){
  //get user pass hash
  $query = "SELECT password FROM users WHERE id='".$_SESSION['id']."' ";
  $run = mysqli_query($mysqli, $query);
  $pass_from_database = mysqli_fetch_assoc($run);
  $entred_pass = mysqli_real_escape_string($mysqli, md5(md5($_POST['password-remove-class'].$_SESSION['email'])));
  // print_r($entred_pass);
  $db_pass = $pass_from_database["password"];
  if($db_pass == $entred_pass){//if pass matches
    //use class id to get class_code
    $query = "SELECT class_code FROM classes WHERE id = '".$_GET['class']."'";
    $run = mysqli_query($mysqli, $query);
    $result = mysqli_fetch_assoc($run);
    $class_code = $result['class_code'];
    //delete class record
    $query = "DELETE FROM classes WHERE class_code = '".$class_code."'";
    $run = mysqli_query($mysqli, $query);
    // start deleteing from regeistred class
    $query = "DELETE FROM class_registered WHERE registered_class = '".$class_code."'";
    $run = mysqli_query($mysqli, $query);
    // Delete from sections
    $query = "DELETE FROM section WHERE class_code='".$class_code."'";
    $run = mysqli_query($mysqli, $query);
    //remove all grades
    $query = "DELETE FROM section_grade WHERE class_code='".$class_code."'";
    $run = mysqli_query($mysqli, $query);
    header("Location: ../teacher-dashboard.php"); /* Redirect browser */
  }else{
    header("Location: ../manage-class.php?"); /* Redirect browser */
    $errors = ['You password is wrong'];

  }
}

 ?>
