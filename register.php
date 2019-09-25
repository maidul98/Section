<?php
//start session
session_start();
if(isset($_SESSION['id'])){
// redirect to 404
}

include 'include/register.php';
?>
<!DOCTYPE html>
<html lang="en">
  <?php include 'header.php';?>
  <body id="regesterStudnet">
      <!--content-->
      <div class="bodyContainer" style="padding:0px;">
        <form class="loginForm" action="" method="post">
          <img src="img/logo.png" class="logoImg">
          <div class="innerFrom">
          <div class="type-user">
            <a href="student-register.php"><div class="type-studnet loginSubmit">Studnet</div></a>
            <a href="teacher-register.php"><div class="type-studnet loginSubmit">Teacher</div></a>
          </div>
            <ul>
              <a href="index.php"><li>Login</li></a>
              <a href=""><li>Lost password</li></a>
            </ul>
          </div>
        </form>
      </div>
  <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <script src="js/userView.js"></script>
  <script src="js/register.js"></script>
  </body>
</html>
