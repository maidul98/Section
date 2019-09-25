<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'header.php';
include 'include/join-class.php';
include 'include/func.php'; ?>
<body id="teacher-classes">
  <script>
</script>
    <?php include 'nav.php';?>
    <div class="outerConatiner">
        <div class="bodyContainer">
          <div class="addClassButton">Join class</div>
          <div class="cf"></div>
          <table class="basicTable classesList">
              <tr class="tableHead">
                  <td>
                      <p>Classes</p>
                  </td>
              </tr>
          <?php
          $query = "SELECT * FROM classes LEFT JOIN class_registered ON classes.class_code = class_registered.registered_class
          WHERE class_registered.id_of_user = ".$_SESSION['id']."";
          $run = mysqli_query($mysqli, $query);
          $num_class = mysqli_num_rows($run); // count number of classes
          if(!$num_class){
            $errors[] = "You have no classes. Add a new class.";
          }
          while($class_info = mysqli_fetch_array($run)){
            echo
            '
                <tr>
                    <td>
                        <a href="student-sections.php?class='.$class_info['class_code'].'">'.$class_info['class_title'].'</a>
                        <a href="include/delete-class.php?delete-student-class='.$class_info['class_code'].'"><span class="remove-class-link">Remove class</span></a>
                    </td>
                </tr>
            '
          ;}
          ?>
        </table>
          <?php //errors from creating a new class
          if(count($errors) > 0){
          echo '<div class="soft-warning slideDown()">';
          for($i=0; $i<count($errors); $i++){
            echo '<p>' . $errors[$i] . '</p>';
          }}
          echo '</div>';
          ?>

          <div class="enter-class-details">
            <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
              <input class="editSectionName make_class" name="class_code" placeholder="Enter 5 digit code provided my your instructor" type="text" >
              <button name="create_class" class="create-class">Join</button>
            </form>
          </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
