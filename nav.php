<?php
//if user not logged in then redirect to login page
if(!isset($_SESSION['id'])){
header('Location:index.php');
die();
}

//current user details
if(isset($_SESSION['id'])){
$query="SELECT * FROM users WHERE id =".$_SESSION['id']."";
$result = mysqli_query($mysqli, $query);
$loggedInUserDetail = mysqli_fetch_array($result);

}
 ?>
<div class="nav">
  <div class="outerConatiner">
    <div class="nav-logo">
      <img src="img/logo.png">
    </div>
    <ul class="navbar">
      <!-- Different users have diffreent index pages -->
      <?php if($_SESSION['userType'] == "teacher"): ?>
      <li><span>Classes</span></li>
      <li><span>All</span></li>
      <?php endif ?>
    </ul>
    <div class="userPic">
      <?php
      $name = $loggedInUserDetail['name'];
      $parts = explode(" ", $name);
      $lastname = array_pop($parts);
      $firstname = implode(" ", $parts);
      ?>

      <div class="user-name">
      <?php
            if($firstname == ""){
              echo 'Hello, '.ucfirst($loggedInUserDetail['name']);
            }else{
              echo 'Hello, '.ucfirst($firstname);
            }
      ?>
      </div>
      <img class="user-img" src="img/userIcon.png">
      <div class="userDropDown" style="display: none;">
      <ul>
        <a href="settings.php"><li>Setting</li></a>
        <a href="include/logout.php?logout=1"><li>Logout</li></a>
      </ul>
      </div>
    </div>
    <div class="clearBoth"></div>
</div>
</div>
