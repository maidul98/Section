<?php
$errors = array();

if(isset($_POST['create_class'])){
  if($_POST['class_name'] == ""){
    $errors[] = "Please enter a class name";
  }
  if(strlen($_POST['class_name'])>42){
    $errors[] = "Class name has to be less then 42 charaters";
  }
  if(strlen($_POST['class_name'])<6){
    $errors[] = "Class name has to be greater than 6 charaters";
  }
  if(count($errors) == 0){
    $query = "INSERT INTO classes (date_created, class_title, class_code, created_by_user_id) VALUES (NOW(), '".mysqli_real_escape_string($mysqli, $_POST['class_name'])."','".substr(md5(uniqid()), 0, 5)."','".$_SESSION['id']."' )";
    mysqli_query($mysqli, $query);
  }

}
 ?>
