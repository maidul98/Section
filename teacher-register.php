<?php
//start session
session_start();
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
            <?php
            //warning message
             if(count($errors)>0){
              echo '<ul id="errors-list">';

                  foreach($errors as $error){
                    echo '<li>' . $error . '</li>';
                  }
              echo '</ul>';
            }
            //success message
            if(count($success)>0){
             echo '<ul id="success-list">';

                 foreach($success as $message){
                   echo '<li>' . $message . '</li>';
                 }
             echo '</ul>';
           }
            ?>
           <!-- SIGN UP FOR TEACHER -->
           <div class="create_account_teacher">
             <label for="email"></label>
             <input type="email" placeholder="Email" id="email" class="email_register" name="email">
             <label for="name"></label>
             <input type="text" placeholder="Name" id="name"  class="name_register"name="name">
             <label for="user-name"></label>

               <label for="password"></label>
               <input style="margin-bottom: 10px;" type="password" placeholder="Password" id="password"  class="password_register" name="password">


               <label for="password"></label>
               <input type="password" placeholder="Confirm Password" id="password"  class="password_register" name="comfpassword">

             <button name="teacher-register" type="submit" id="teacher-register" class="loginSubmit">Register</button>
             <div id="next_register" class="loginSubmit" style="display:none">Next</div>
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
