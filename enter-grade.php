<?php session_start();
//databcase connnection
include 'include/connection.php';
//function file
include 'include/func.php';

//insert grade
// $query = "INSERT  INTO section_grade(grade, student_id, class_code, section_id, inserted_by_id) VALUES()";
//

//checks befoe running $_GET
$query = "SELECT * FROM class_registered WHERE registered_class='".$_GET['class']."' AND id_of_user='".$_GET['student']."'";//match studnet id to current class
$run = mysqli_query($mysqli, $query);
$class_and_student_match = mysqli_num_rows($run); // finds out wheather the data existes


$query = "SELECT * FROM section WHERE created_by_user_id='".$_SESSION['id']."'";// get all sections by user id
$run = mysqli_query($mysqli, $query);

$class_code = array();
while($result = mysqli_fetch_array($run)){
  $class_code[] = $result['class_code']; //out puts the class code X amount of sections
}

//error array
$error = array();

if (in_array($_GET['class'], $class_code) and $class_and_student_match > 0){//only run if the user is registered
  //get user details
  $query = "SELECT * FROM users WHERE id='".$_GET['student']."'";
  $run = mysqli_query($mysqli, $query);
  $user_info = mysqli_fetch_array($run);

//must last
}else{
  $error[] = "You do not have accsess to this page";
}
 ?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'header.php';?>
  <body id="teacher-classes">
      <!--nav bar-->
        <?php include 'nav.php';?>
      <i class="fa fa-university" aria-hidden="true"></i>
      <div class="outerConatiner">
      <!--content-->
      <div class="bodyContainer enter-grades">
        <!-- Error message -->
        <?php
          foreach ($error as $error) {
          soft_warning($error);
        } ?>
        <?php if(!$error): ?> <!-- If there is a error then don't show anything -->
        <h3 class='student-name'><?php print_r($user_info['name']) ?>'s grades</h3>
        <table class="basicTable">
            <tr class="tableHead">
              <td><p>Section title</p></td>
              <td><p>Grade</p></td>
            </tr>
                        <?php
                        $query = "
                        SELECT section.section_id, section.section_name, grades.grade FROM section
                        LEFT JOIN (SELECT * FROM section_grade WHERE student_id = '".$_GET['student']."') grades
                        ON section.section_id = grades.section_id
                        WHERE section.class_code = '".$_GET['class']."'
                        ";
                        $run = mysqli_query($mysqli, $query);
                        while($graded_sections = mysqli_fetch_assoc($run)):?>
                                  <td><a href="#"> <?php echo $graded_sections['section_name'] ?></a></td>
                                  <td id="enter-grade">
                                    <label><input type="radio" name="<?php echo $graded_sections['section_id'] ?>" <?php if ($graded_sections['grade'] == 55): ?> checked = "checked" <?php endif ?> value="55"> Needs revision</label>
                                    <label><input type="radio" name="<?php echo $graded_sections['section_id'] ?>" <?php if ($graded_sections['grade'] == 65): ?> checked = "checked" <?php endif ?> value="65"> Competent</label>
                                    <label><input type="radio" name="<?php echo $graded_sections['section_id'] ?>" <?php if ($graded_sections['grade'] == 85): ?> checked = "checked" <?php endif ?> value="85"> Accomplished</label>
                                    <label><input type="radio" name="<?php echo $graded_sections['section_id'] ?>" <?php if ($graded_sections['grade'] == 95): ?> checked = "checked" <?php endif ?> value="95"> Exemplary</label>
                                  </td>
                                  </tr>
                        <?php endwhile ?>
        </table>
        <div class="saved-success"></div><button type="button" class="save loginSubmit">Save</button>
        </div>
      <?php endif ?>
        </div>

      </div>
  </div>
<?php include 'footer.php' ?>
<script src="js/enter-grade.js"></script>

  </body>
</html>
