<?php session_start();
//databcase connnection
include 'include/connection.php';
//function file
include 'include/func.php';

//run query to get data from db
$query = "SELECT * from classes WHERE id=".$_GET['class']."";
$run = mysqli_query($mysqli, $query);
$classInfo = mysqli_fetch_array($run);
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'header.php';?>
  <body id="teacher-classes">
   <?php include 'nav.php';?> <!--nav bar-->
    <i class="fa fa-university" aria-hidden="true"></i>
    <div class="outerConatiner">
      <!--content-->
        <div class="bodyContainer">
          <h3 class="class-title"><?php print($classInfo['class_title']) ?></h3>
          <form action="include/manage-scripts.php">
            <p>Update class name</p>
            <input class="setting" value="<?php echo $classInfo['class_title'] ?>" type="text" name="update-class-name">
            <input name="class-id" value="<?php echo $classInfo['id'] ?>" type="hidden">
            <input type="submit" class="setting-save" value="Save">
          </form>
          <br>
          <!-- delete class -->
          <form action="include/delete-class.php?class=<?php print($_GET['class']) ?>" method="post">
            <input name="password-remove-class" class="setting" type="password" placeholder="Enter password to remove class permanently" name="password">
            <button class="setting-save remove-class" type="submit" >Remove class</button>
          </form>

          <?php //errors from creating a new class
          if(count($errors) > 0){
          echo '<div class="soft-warning slideDown()">';
          for($i=0; $i<count($errors); $i++){
            echo '<p>' . $errors[$i] . '</p>';
          }}
          echo '</div>';
          ?>
        </div>
      </div>
    <?php include 'footer.php' ?>
    <script>
    $(".remove-class").click(function(event){
      if (confirm("Are you sure you want to delete this class? All sections, grades and students will be removed from this class permanently. ") == true) {//meaning you clicked yes
    } else {//pressed cancel
        event.preventDefault();
    }
    });
    </script>
  </body>
</html>
