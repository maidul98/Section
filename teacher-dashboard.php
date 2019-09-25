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
      <div class="addClassButton">Essay</div>
      <div class="cf"></div>
        <table class="basicTable classesList">
          <?php if($num_results>0) :?>
          <tr class="tableHead">
            <td><p>Essays</p></td>
            <td><p>Studnets</p></td>
            <td><p>Sections</p></td>
          </tr>
        <?php endif ?>
        <?php if($num_results>0){//if there is results
          while($classesInfo = mysqli_fetch_array($run)){//as long as there are arrays of data
          echo '<tr>';
          echo '<td><p><a href ="class.php?class='.$classesInfo['id'].'">'.$classesInfo['class_title'].'</p></a></td>';
          echo '<td><p>'.$classesInfo['num_studnets'].'</p></td>';
          echo '<td><p>'.$classesInfo['num_sections'].'</p></td>';
          echo '</tr>';
          echo '</div>';
          // print_r($classesInfo);
        }
      }else{//if no classes give warning
          info_warning('You do not have any active classes, create one below');
        } ?>
      </table>
      <?php if($num_results >= 0): ?>
      <div class="enter-class-details">
        <form method="post">
          <input class="editSectionName make_class" name="class_name" placeholder="Enter essay name" type="text" >
          <button name="create_class" class="create-class">Create</button>
        </form>
      </div>
      <?php endif ?>
        <?php //errors for creating a new class
        if(count($errors) > 0){
        echo '<div class="soft-warning slideDown()">';
        for($i=0; $i<count($errors); $i++){
          echo '<p>' . $errors[$i] . '</p>';
        }}
        echo '</div>';
        ?>
        </div>
        </div>

      </div>
  </div>
<?php include 'footer.php' ?>
  </body>
</html>
