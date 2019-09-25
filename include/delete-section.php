<?php
session_start();
//databcase connnection
include 'connection.php';

print_r($_POST);

$query = "SELECT * FROM section WHERE section_id='".$_POST['delete-section']."'";
$run = mysqli_query($mysqli, $query);
$section_match = mysqli_fetch_array($run);

if($_SESSION['id'] == $section_match['created_by_user_id']){//only the user who created can delete the section
  //find the class-code
  $query = "SELECT * FROM section WHERE section_id='".$_POST['delete-section']."'";
  $result = mysqli_query($mysqli, $query);
  $section_info = mysqli_fetch_array($result);
  //delete section
  $query = "DELETE  FROM section WHERE section_id='".$_POST['delete-section']."'";
  mysqli_query($mysqli, $query);

  //find out how many sections there are for this class code
  $query = "SELECT * FROM section WHERE class_code='".$section_info['class_code']."'";
  $result = mysqli_query($mysqli, $query);
  $num_of_setions_for_class = mysqli_num_rows($result);

  //add the number of sections there for this class to the class info
  $query = "UPDATE classes SET num_sections='".$num_of_setions_for_class."' WHERE class_code='".$section_info['class_code']."'";
  $result = mysqli_query($mysqli, $query);
}

 ?>
