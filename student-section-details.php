<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <?php
  include 'header.php';
  //function file
  include 'include/func.php';
  //check to see if student is in that GET class first before doing the query
  $query = "SELECT * FROM class_registered WHERE id_of_user ='".$_SESSION['id']."' AND registered_class = '".$_GET['class']."'";
  $run = mysqli_query($mysqli, $query);
  $if_result = mysqli_num_rows($run);
  ?>
  <body>
      <!--nav bar-->
    <?php include 'nav.php';?>
      <div class="outerConatiner">
      <!--content-->
      <div class="bodyContainer">
        <!--LT-->
        <?php if ($if_result > 0):   //student is registred for the class they are viewing ?>
        <!-- top block -->
        <?php
        $query = 'SELECT * FROM section WHERE section_id = "'.$_GET['id'].'"';
        $run = mysqli_query($mysqli, $query);
        $grade_details = mysqli_fetch_array($run);
         ?>
        <h1 class="sectionTitle text-color">Sections &raquo; <?php echo $grade_details['section_name'] ?></h1>
        <div class="over-view">
          <div class="row">
            <div class="col-2 grades-tl">
              <div class="cf"></div>
              <div class="inner">
                <div class="learning-target-header"><p><?php echo $grade_details['section_lt'] ?></p></div>
                <hr>
                  <div class="vertically-center">
                    <div class="cf"></div>
                    <div class="col-2">
                      <div class="due-date">
                        <?php
                        $a = new DateTime('now');
                        $b = date_create($grade_details['due_date']);
                        $a->diff($b);
                        $diff = $a->diff($b); echo $diff->days;
  ?><span class="small-text"> days left</span></div>
                    </div>
                    <div class="col-2">
                      <div class="garde">Not graded</div>
                    </div>
                    <div class="cf"></div>
                 </div>
              </div>
            </div>
            <div class="col-2 feedback">
              <div class="inner">
                <div class="feedback-header"><p>&nbsp;</p></div>
                <hr>
                <div class="feedback-box"><p>
                <?php echo $grade_details['section_description'] ?>
                </p></div>
              </div>
            </div>
          </div>
      </div>
        <!-- descritpion -->
        <span class="cf"></span>
        <div class="studentRubric student">
          <div class="row rubricBg">
            <div class="col exem rubricBox">
              <p class="exemplaryColor gradeTitle">Exemplary</p>
              <p class="text-color"><?php echo $grade_details['exemplary'] ?></p>
            </div>
            <div class="col acco rubricBox">
              <p class="accomplishedColor gradeTitle">Accomplished</p>
              <p class="text-color"><?php echo $grade_details['accomplished'] ?></p></div>
            <div class="col comp rubricBox">
              <p class="competentColor gradeTitle">Competent</p>
              <p class="text-color"><?php echo $grade_details['exemplary'] ?></p></div>
            <div class="col noMas rubricBox">
              <p class="nomasColor gradeTitle">No Mastery</p>
              <p class="text-color"><?php echo $grade_details['no_mastery'] ?></p></div>
              <div class="cf"></div>
          </div>
          <div class="cf"></div>
        </div>

      <?php else: ?>
        <?php info_warning('You can only view sections that you are registered to'); ?>
      <?php endif ?>

      </div>
  </div>
 <?php include 'footer.php' ?>
  </body>
</html>
