<?php
session_start();
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
        <div class="searchBar" placeholder="Search studnet">
            <input type="search">
        </div>
        <table class="basicTable">
            <tr class="tableHead">
              <td><p>Name</p></td>
              <td><p>Average </p></td>
            </tr>
            <tr>
              <td><a href="teacherStudnetDetail.php">Kim</a></td>
              <td>98</td>
            </tr>
            <tr>
              <td><a href="#">Maidul</a></td>
              <td>75</td>
            </tr>
            <tr>
              <td><a href="#">Ken</a></td>
              <td>90</td>
            </tr>
        </table>
        </div>
        </div>

      </div>
  </div>
    <?php include 'footer.php' ?>
  </body>
</html>
