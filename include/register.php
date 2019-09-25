<?php
//databcase connnection
include 'include/connection.php';
include 'include/func.php';
$errors = array();

$success = array();


//studnet register

if(isset($_POST['student_register'])) {

    //check email
    if(empty($_POST['email'])){
      $errors[] = "You must enter a email";
    }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $errors[] = "Please enter valid email";
    }

    //check name

    if(empty($_POST['name'])){
      $errors[] = "You must enter your name";
    }

    //Check password

    if(empty($_POST['password'])){
      $errors[] = "You must enter a password";
    }elseif($_POST['password'] != $_POST['comfpassword']){
      $errors[] = "Password does not match";
    }

    //valid, checking user to see if they are already registered

    if(count($errors)<1){
      $user_email="SELECT * FROM users WHERE email='".mysqli_real_escape_string($mysqli, $_POST['email'])."'";
      //running the query
      $result_for_user_email = mysqli_query($mysqli, $user_email);
      //set num_results_user_email to the number of results
      $num_results_user_email = mysqli_num_rows($result_for_user_email);

      //check if class code enered is valid
      $user_class_code = "SELECT * FROM classes WHERE  class_code='".mysqli_real_escape_string($mysqli, $_POST['class_code'])."'";

      $result_for_class_code = mysqli_query($mysqli, $user_class_code);

      $num_results_for_class_code = mysqli_num_rows($result_for_class_code);

      if ($num_results_user_email > 0 ){
        $errors[] = "The email you ented is already taken";
        //you need to check if the code they ener is valid
      }elseif(!$num_results_for_class_code){
        $errors[] = "The code you entred is incorrect";
      }else{

        $insert_user = "INSERT INTO `users` (`email`, `name`, `password`, `permission`, `date_registered`) VALUES ('".mysqli_real_escape_string($mysqli, $_POST['email'])."', '".mysqli_real_escape_string($mysqli, $_POST['name'])."', '".mysqli_real_escape_string($mysqli, md5(md5($_POST['password'].$_POST['email'])))."', 'student', NOW())";
        mysqli_query($mysqli, $insert_user);
        $success[] = "You are registred";
        $_SESSION['id'] = mysqli_insert_id($mysqli);

        //get ur detials
        $query = "SELECT * FROM users WHERE id=".$_SESSION['id']."";
        $run = mysqli_query($mysqli, $query );
        $userDetail = mysqli_fetch_array($run);

                // register student for class
                $query = "INSERT INTO `class_registered` (`id_of_user`, `registered_class`) VALUES ('".$userDetail['id']."', '".$_POST['class_code']."')";
                mysqli_query($mysqli, $query);

                //Find how many studnets are registered for that class
                $query = "SELECT * FROM class_registered WHERE registered_class='".$_POST['class_code']."'";
                $result = mysqli_query($mysqli, $query);
                $num_of_students_in_class = mysqli_num_rows($result);

                //Update that number in the classes table
                $query = "UPDATE classes SET num_studnets = num_studnets+1 WHERE class_code='".mysqli_real_escape_string($mysqli, $_POST['class_code'])."'";
                mysqli_query($mysqli, $query);//run the query

        //define type of user
        $_SESSION['userType'] = $userDetail['permission'];
        $_SESSION['name'] = $userDetail['name'];
        $_SESSION['id'] = $userDetail['id'];
        //redercect based on user type
        typeOfUser();
      }
    }
}


//teacher-register
if(isset($_POST['teacher-register'])) {
      //check email
      if(empty($_POST['email'])){
        $errors[] = "You must enter a email";
      }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please enter valid email";
      }

      //check name

      if(empty($_POST['name'])){
        $errors[] = "You must enter your name";
      }

      //Check password

      if(empty($_POST['password'])){
        $errors[] = "You must enter a password";
      }elseif($_POST['password'] != $_POST['comfpassword']){
        $errors[] = "Password does not match";
      }

      //valid, checking user to see if they are already registered

      if(count($errors)<1){
        $user_email="SELECT * FROM users WHERE email='".mysqli_real_escape_string($mysqli, $_POST['email'])."'";
        //running the query
        $result_for_user_email = mysqli_query($mysqli, $user_email);
        //set num_results_user_email to the number of results
        $num_results_user_email = mysqli_num_rows($result_for_user_email);

        if ($num_results_user_email > 0 ){
          $errors[] = "The email you ented is already taken";
          //you need to check if the code they ener is valid
        }else{
          $insert_user = "INSERT INTO `users` (`email`, `name`, `password`, `permission`, `date_registered`) VALUES ('".mysqli_real_escape_string($mysqli, $_POST['email'])."', '".mysqli_real_escape_string($mysqli, $_POST['name'])."', '".mysqli_real_escape_string($mysqli, md5(md5($_POST['password'].$_POST['email'])))."', 'teacher', NOW())";
          mysqli_query($mysqli, $insert_user);
          $success[] = "You are registred";
          $_SESSION['id'] = mysqli_insert_id($mysqli);
          //get ur detials
          $query = "SELECT * FROM users WHERE id=".$_SESSION['id']."";
          $run = mysqli_query($mysqli, $query );
          $result = mysqli_fetch_array($run);

          //set session
          $_SESSION['id'] = $result['id'];
          $_SESSION['userType'] = $result['permission'];
          //redercect based on user type
          typeOfUser();
        }
      }
}

 ?>
