<?php session_start();
//databcase connnection
include 'include/connection.php';
//function file
include 'include/func.php';
//create class file
include('include/create-class.php');
//run query to get data from db
$query = "SELECT * from classes WHERE id=".$_GET['class']."";
$run = mysqli_query($mysqli, $query);
$classInfo = mysqli_fetch_array($run);

//grab all the studntes id in the class
$query = "SELECT * from class_registered WHERE registered_class='".$classInfo['class_code']."'";
$run = mysqli_query($mysqli, $query);
$students_id = array();
while($users_in_class = mysqli_fetch_array($run)){
  $students_id[] = $users_in_class['id_of_user'];
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
        <div class="bodyContainer">
        <h3 class="class-title"><?php print($classInfo['class_title']) ?></h3>
          <div class="manage left class-over-view">
              <ul>
                <li><a href="manage-class.php?class=<?php print_r($_GET['class']) ?>"><button type="button"  class="loginSubmit manage-class-butt ">Manage essay</button></a></li>
                <li><a href="edit-view-section.php?class=<?php print_r($_GET['class']) ?>"><button type="button" class="loginSubmit manage-class-butt manage-section">Manage sections</button></a></li>
              </ul>
          </div>
            <div class="searchBar right">
                <input type="search" placeholder="Search studnets">
            </div>
          </div>
          <div class="cf"></div>
            <p class="class-code">Your essay code is <b id="class-code-number"><?php print_r($classInfo['class_code']) ?></b></p>
            <script>

            </script>
          <?php if(count($students_id) >1): ?>
            <table class="basicTable">
                <tr class="tableHead">
                  <td><p>Name</p></td>
                  <td><p>Grade </p></td>
                </tr>
                <?php
                error_reporting(0);
                  foreach($students_id as $value){
                    $query = "SELECT * from users WHERE id='".$value."'";
                    $run = mysqli_query($mysqli, $query);
                    $students = mysqli_fetch_array($run);

                    //find the class code they are in

                    $query = "SELECT * from class_registered WHERE id_of_user='".$value."'";
                    $run = mysqli_query($mysqli, $query);
                    $class_code_in = mysqli_fetch_array($run);

                    //match student id to section grade table and add all the grades and devide by number of grades

                     $query = "SELECT grade FROM section_grade WHERE student_id = '".$value."'";
                     $run = mysqli_query($mysqli, $query);
                     $grades = mysqli_fetch_array($run);//get grade
                     $average = ((array_sum($grades))/3);

                     if($average == 0){
                       $grade = "Not graded";
                     }elseif ($average > 85 && $average < 90) {
                       $grade = 'Accomplished '."(".round($average).'%)';
                     }elseif ($average > 90 || $average == 95) {
                       $grade = 'Exemplary '."(".round($average).'%)';
                     }elseif ($average > 55 && $average < 85) {
                       $grade = 'Begining '."(".round($average).'%)';
                     } else {
                       # code...
                     }
                    echo '<tr>
                      <td><a href="enter-grade.php?student='.$students['id'].'&class='.$class_code_in['registered_class'].'">'.$students['name'].'</a></td>
                      <td>'.$grade.'</td>
                    </tr>';
                  }

                ?>
            </table>
          <?php elseif(count($students_id) == 0): ?>
              <?php info_warning('You do not have any students in this class') ?>
            <?php endif; ?>
        </div>
        </div>

      </div>
  </div>
<?php include 'footer.php' ?>

  </body>
</html>
