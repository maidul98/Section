<?php session_start();
//databcase connnection
include 'include/connection.php';
//function file
include 'include/func.php';
//create class file
include('include/create-class.php');

//run query to get data from db
$query = "SELECT * from classes WHERE created_by_user_id=".$_SESSION['id']."";
$run = mysqli_query($mysqli, $query);
$num_results = mysqli_num_rows($run);

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
          <!-- <h3 class="class-title">Sections</h3> -->
          <table class="basicTable">
            <?php if($num_results>0) :?>
            <tr class="tableHead">
              <td><p>Classes</p></td>
              <td><p>Sections</p></td>
            </tr>
          <?php endif ?>
          <?php if($num_results>0){//if there is results
            while($classesInfo = mysqli_fetch_array($run)){//as long as there are arrays of data
            echo '<tr>';
            echo '<td><p><a href ="edit-view-section.php?class='.$classesInfo['id'].'">'.$classesInfo['class_title'].'</p></a></td>';
            echo '<td><p>'.$classesInfo['num_sections'].'</p></td>';
            echo '</tr>';
            echo '</div>';
            // print_r($classesInfo);
          }
        }else{//if no classes give warning
            info_warning('You do not have any active classes, create one below');
          } ?>
        </table>
        </div>
        </div>

        <?php
        ?>
<?php include 'footer.php' ?>
  </body>
</html>
