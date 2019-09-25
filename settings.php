<?php session_start();
//databcase connnection
include 'include/connection.php';
//function file
include 'include/func.php';

// query

$query = "";
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
      <?php
       ?>
        <div class="bodyContainer">
          <form action="include/settings.php" method="get">
            <p>Name</p>
            <input class="setting"placeholder="<?php echo $_SESSION['name'] ?>" type="text" name="name">
            <input type="submit" class="setting-save" value="Save">
          </form>

          <form action="include/settings.php" method="get" >
            <p>Update password</p>
            <input class="setting" type="text" name="password">
            <input type="submit" class="setting-save" value="Save">
          </form>

          <form action="include/settings.php" method="get">
            <p>Update E-mail</p>
            <input class="setting" placeholder="<?php echo $_SESSION['email'] ?>" type="text" name="update-email">
            <input type="submit" class="setting-save" value="Save">
          </form>
        </div>
        </div>
<?php include 'footer.php' ?>

  </body>
</html>
