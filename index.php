<?php
//start session
include('include/login.php');
$page_title = "Section";
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'header.php';?>
  <body id="login">
      <!--content-->
      <div class="bodyContainer" style="padding:0px;">
        <form class="loginForm" method="post">
          <img src="img/logo.png" class="logoImg">
          <div class="innerFrom">
						<?php

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
            <p>
							Login into Section
            </p>
            <label for="email"></label>
            <input type="email" name="email" placeholder="Email" id="email">
            <label for="password"></label>
            <input type="password" placeholder="Password" name="password" id="password">
            <button type="submit" name="login_button" class="loginSubmit">Login</button>
            <ul>
              <a href=""><li>Lost pasword</li></a>
              <a href="register.php"><li>Register</li></a>
            </ul>
          </div>
        </form>
      </div>
  <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <!-- <script src="js/userView.js"></script> -->
    <script src="js/register.js"></script>
  </body>
</html>
