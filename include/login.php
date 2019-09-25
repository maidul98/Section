<?php
session_start();
include 'include/connection.php';
include 'include/func.php';
//if logged out
$errors = array();
$success = array();

//check if the user is still on sesstion and url is logout
if(isset($_GET["logout"]) == 1 AND isset($_SESSION['id'])){
  session_destroy();
  $success[] = "Logged out";
}

if(isset($_POST['login_button'])){
  if(empty($_POST['email'])){
    $errors[] = "Please enter a email";
  }

  if(empty($_POST['password'])){
    $errors[] = "Please enter a password";
  }

  if(count($errors) == 0){
    $user_email_and_password="SELECT * FROM users WHERE email='".mysqli_real_escape_string($mysqli, $_POST['email'])."' AND password='".mysqli_real_escape_string($mysqli, md5(md5($_POST['password'].$_POST['email'])))."'";

    $result_of_user_email_and_password = mysqli_query($mysqli, $user_email_and_password);

    $num_of_results_for_user_email_and_password = mysqli_fetch_array($result_of_user_email_and_password);

    if($num_of_results_for_user_email_and_password){
      //login
      $_SESSION['id'] = $num_of_results_for_user_email_and_password['id'];
      $_SESSION['userType'] = $num_of_results_for_user_email_and_password['permission'];
      $_SESSION['name'] = $num_of_results_for_user_email_and_password['name'];
      $_SESSION['email'] = $num_of_results_for_user_email_and_password['email'];

      //redercect based on user type
      typeOfUser();
    }else{
      $errors[] = "Incorrect password or email";
    }
  }
}

?>
