<?php
  $errors = array();

if(isset($_POST['create_class'])){

      if($_POST['class_code'] == ""){//if class code entered is empty, then give error
        $errors[] = "Please enter a class code";
      }
      if(strlen($_POST['class_code'])>5){//if the length of the class code is greater then 5 then give error
        $errors[] = "Class codes are only 5 letters and numbers in length";
      }
      //check to see if the student is already registered for that class
      $query = "SELECT * FROM class_registered WHERE id_of_user = '".$_SESSION['id']."' AND registered_class = '".mysqli_real_escape_string($mysqli, $_POST['class_code'])."' ";
      $result = mysqli_query($mysqli, $query);
      $is_registered = mysqli_num_rows($result);

      if(count($errors) == 0){//if no errors from above then continue
        if($is_registered < 1){//checks to see if there the studnet is alreay registered
          //register student if all goes well
          $query = "INSERT INTO class_registered (id_of_user,registered_class) VALUES(".$_SESSION['id'].",'".mysqli_real_escape_string($mysqli, $_POST['class_code'])."')";
          mysqli_query($mysqli, $query);//run the query

          //also update the number of students in this class
          $query = "UPDATE classes SET num_studnets = num_studnets+1 WHERE class_code='".mysqli_real_escape_string($mysqli, $_POST['class_code'])."'";
          mysqli_query($mysqli, $query);//run the query
          // header("Refresh:0");// refresh the page
        }else{
          $errors[] = "You are already registered for this class";
        }
      }
}
 ?>
