<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <?php
    include 'header.php';
    include 'include/func.php';
    //check to see if student is in that GET class first before doing the query
    $query = "SELECT * FROM class_registered WHERE id_of_user ='".$_SESSION['id']."' AND registered_class = '".$_GET['class']."'";
    $run = mysqli_query($mysqli, $query);
    $if_result = mysqli_num_rows($run);
    //student is registred for the class they are viewing
    if($if_result > 0){//$number section wil be set if check passes
      $query="SELECT section_name FROM section WHERE class_code='".$_GET['class']."'";
      $run = mysqli_query($mysqli, $query);
      $numer_sections = mysqli_fetch_array($run);
    }
    ?>
  <body id="teacher-classes sectionForClass">
      <!--nav bar-->
      <?php include 'nav.php';?>
      </div>
  <div class="outerConatiner">
      <div class="bodyContainer">
        <?php if (isset($numer_sections)): //if num section is not set this means that if did not get though the check and is unset ?>
        <table class="basicTable student-classes">
            <tr class="tableHead">
            <td><p>Sections</p></td>
            <td><p>Grade</p></td>
            </tr>


            <?php
            $query="SELECT section_name, section_id FROM section WHERE class_code='".$_GET['class']."'";
            $run = mysqli_query($mysqli, $query);

            while($result = mysqli_fetch_assoc($run)){
              echo'
                <tr>
                <td><a href="student-section-details.php?'."class=".$_GET['class']."&"."id=".$result['section_id'].'">'.$result['section_name'].'</a></td>
                <td><i>Not graded</i></td>
                </tr>

                ';
            }
            ?>
        </table>
      <?php else: ?>
        <?php info_warning('Your intructer has not yet made any sections for this class or you are accessing a class you are not registered for'); ?>
      <?php endif ?>
        </div>
      </div>
  </div>
  <?php include 'footer.php';?>
  </body>
</html>
