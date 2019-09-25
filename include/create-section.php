<?php
session_start();
//databcase connnection
include 'connection.php';

if($_POST){
  $errors = array();

  if(empty($_POST['section_name'])){
    $errors[] = "Please enter a section name";
  }

  if(empty($_POST['due_date'])){
    $errors[] = "Please enter a due date";
  }

  if(empty($_POST['section_lt'])){
    $errors[] = "Please enter a section learning target";
  }

  foreach ($errors as $error) {
    echo '<p>' . $error . '</p>';
  }


  if(count($errors) == 0){//if no errors prosess the form
    //get class_code
    $query = "SELECT * from classes WHERE id=".$_GET['class']."";
    $run = mysqli_query($mysqli, $query);
    $class_code = mysqli_fetch_array($run);
    //creating new section below
    $query = "INSERT INTO
    section(section_name, no_mastery,	exemplary, competent, accomplished, due_date, section_description, section_lt, created_by_user_id, class_code)
    VALUES('".mysqli_real_escape_string($mysqli, $_POST['section_name'])."',
     '".mysqli_real_escape_string($mysqli, $_POST['no_mastery'])."',
     '".mysqli_real_escape_string($mysqli, $_POST['exemplary'])."',
     '".mysqli_real_escape_string($mysqli, $_POST['competent'])."',
     '".mysqli_real_escape_string($mysqli, $_POST['accomplished'])."',
     '".mysqli_real_escape_string($mysqli, $_POST['due_date'])."',
     '".mysqli_real_escape_string($mysqli, $_POST['section_description'])."',
     '".mysqli_real_escape_string($mysqli, $_POST['section_lt'])."',
     '".$_SESSION['id']."',
     '".$class_code['class_code']."')";

      mysqli_query($mysqli, $query);
      //find out how many sections there are for this class code
      $query = "SELECT * FROM section WHERE class_code='".$class_code['class_code']."'";
      $result = mysqli_query($mysqli, $query);
      $num_of_setions_for_class = mysqli_num_rows($result);

      //add the number of sections there for this class to the class info
      $query = "UPDATE classes SET num_sections='".$num_of_setions_for_class."' WHERE class_code='".$class_code['class_code']."'";
      $result = mysqli_query($mysqli, $query);
      // header("Location: http://localhost/edit-view-section.php?class='".$_GET['class']."'"); /* Redirect to list of sections */

      $redirect = 1;

      echo $redirect;


  }


}

 ?>
