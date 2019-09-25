<?php
session_start();
//databcase connnection
include 'connection.php';

$error = false;
foreach ($_POST as $key => $value) {

  $sql = "INSERT INTO
  section_grade(grade, student_id,	class_code, section_id)
  VALUES(
   '".mysqli_real_escape_string($mysqli, $value)."',
   '".mysqli_real_escape_string($mysqli, $_GET['student'])."',
   '".mysqli_real_escape_string($mysqli, $_GET['class'])."',
   '".mysqli_real_escape_string($mysqli, $key)."'
   )
   ON DUPLICATE KEY UPDATE grade = '".mysqli_real_escape_string($mysqli, $value)."'";


   if(mysqli_query($mysqli, $sql)){
    //  echo "Saved";
   }else{
    //  echo "Something went wrong, the edits you made were not saved";
     $error = true;
   }
 }

 if($error){
   echo "Something went wrong, the edits you made were not saved";
 }else{
   echo "Saved";
 }






 ?>
