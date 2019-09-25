<?php
session_start();
//databcase connnection
include 'connection.php';
$query = "SELECT * FROM section WHERE section_id='".$_GET['delete-section']."'";
$run = mysqli_query($mysqli, $query);
$section_match = mysqli_fetch_array($run);

if($_SESSION['id'] == $section_match['created_by_user_id']){//only the user who created can edit the section
  if($_GET['delete-section']){
  $query = "UPDATE section SET
  section_name = '".mysqli_real_escape_string($mysqli, $_POST['section_name'])."',
  no_mastery = '".mysqli_real_escape_string($mysqli, $_POST['no_mastery'])."',
  exemplary = '".mysqli_real_escape_string($mysqli, $_POST['exemplary'])."',
  competent = '".mysqli_real_escape_string($mysqli, $_POST['competent'])."',
  accomplished = '".mysqli_real_escape_string($mysqli, $_POST['accomplished'])."',
  due_date = '".mysqli_real_escape_string($mysqli, $_POST['due_date'])."',
  section_description = '".mysqli_real_escape_string($mysqli, $_POST['section_description'])."',
  section_name = '".mysqli_real_escape_string($mysqli, $_POST['section_name'])."',
  section_lt = '".mysqli_real_escape_string($mysqli, $_POST['section_lt'])."'
  WHERE section_id = '".$_GET['delete-section']."'";
  if(mysqli_query($mysqli, $query)){
    echo "Saved";
  }else{
    echo "Something went wrong, the edits you made were not saved";
  }

  }
}else {
  echo "Something went wrong, the edits you made were not saved";
}

 ?>
