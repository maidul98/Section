<?php
//redirect based on user
function typeOfUser(){
  if($_SESSION['userType'] == "teacher"){
    header("Location:teacher-dashboard.php");
  }

  if($_SESSION['userType'] == "student"){
    header("Location:student-dashboard.php");
  }
}

//warning blue
function info_warning($message){
  echo '<div class="info-warning"><p>'.$message.'</p></div>';
}

//worning grenn
function soft_warning($message){
  echo '<div class="soft-warning"><p>'.$message.'</p></div>';
}


?>
