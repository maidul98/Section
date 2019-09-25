<?php session_start();
//databcase connnection
include 'include/connection.php';
//function file
include 'include/func.php';
//gets info about section
$query = "SELECT * from classes WHERE id=".$_GET['class']."";
$run = mysqli_query($mysqli, $query);
$class_info = mysqli_fetch_array($run);

//page title
$page_title = 'Sections in '.$class_info['class_title'];

//get the info from section table
$query = "SELECT * FROM classes WHERE class_code='".$class_info['class_code']."'";
$result = mysqli_query($mysqli, $query);
$classinfo = mysqli_fetch_array($result);
 ?>
<!DOCTYPE html>
<html lang="en">
  <?php include 'header.php';?>
  <body id="view-section">
      <!--Main nav bar-->
  <?php include 'nav.php';?>
      <!-- END OF NAV -->
      <div class="outerConatiner view-section">
      <!--content-->
      <div class="view-section bodyContainer">
          <h3 class="class-title">Creating section in <?php print(ucfirst($classinfo['class_title'])) ?></h3>
          <div class="error-message"></div>
        <input class="editSectionName create_page" id="section-title" name="section_name" placeholder="Enter section title" type="text">
              <table class="basicTable">
                  <tr>
                    <td>Learning target</td>
                    <td><input class="editSectionName" name="section_lt" id="create-learning-target" placeholder="Learning target" type="text"></td>
                  </tr>
                  <tr>
                    <td>When is this section due?</td>
                    <td><input class="editSectionName" name="due_date" id="section-due-date"  type="date"></td>
                  </tr>
              </table>

                <td><textarea class="editSectionName section_description" name="section_description" id="section-des" placeholder="Details on section" type="date"></textarea>

              <!-- rubric -->
              <div class="studentRubric">
                <span class="moreInfoTitle">Rubric</span>
                <div class="row rubricBg">
                  <div class="col exem rubricBox">
                    <p class="exemplaryColor gradeTitle">Exemplary</p>
                  <textarea class="enterRubricDescription editSectionName" name="exemplary"></textarea>
                  <img class="exemsaveRubricPic" src="img/savingRubric.gif" style="width:16px; height:16px; display:none;">
                  </div>
                  <div class="col acco rubricBox">
                    <p class="accomplishedColor gradeTitle">Accomplished</p>
                    <textarea class="enterRubricDescription editSectionName" name="accomplished"></textarea>
                    <img class="accosaveRubricPic" src="img/savingRubric.gif" style="width:16px; height:16px; display:none;">
                  </div>
                  <div class="col comp rubricBox">
                    <p class="competentColor gradeTitle">Competent</p>
                    <textarea class="enterRubricDescription editSectionName" name="competent"></textarea>
                    <img class="compsaveRubricPic" src="img/savingRubric.gif" style="width:16px; height:16px; display:none;">
                  </div>
                  <div class="col noMas rubricBox">
                    <p class="nomasColor gradeTitle">No Mastery</p>
                    <div class="editRubric">
                      <textarea class="enterRubricDescription editSectionName" name="no_mastery"></textarea>
                      <img class="noMassaveRubricPic " src="img/savingRubric.gif" style="width:16px; height:16px; display:none;">
                    </div>
                  </div>
                    <div class="cf"></div>
                    <!-- save button -->
                    <button class="save create_section loginSubmit">Create</button>
                </div>
                <div class="cf"></div>
              </div>
        </div>
      </div>
  </div>
    <?php include 'footer.php' ?>
    <script src="js/create-section.js"></script>
        <script src="js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.PluginManager.add('placeholder', function (editor) {
            editor.on('init', function () {
                var label = new Label;
                onBlur();
                tinymce.DOM.bind(label.el, 'click', onFocus);
                editor.on('focus', onFocus);
                editor.on('blur', onBlur);
                editor.on('change', onBlur);
                editor.on('setContent', onBlur);
                function onFocus() { if (!editor.settings.readonly === true) { label.hide(); } editor.execCommand('mceFocus', false); }
                function onBlur() { if (editor.getContent() == '') { label.show(); } else { label.hide(); } }
            });
            var Label = function () {
                var placeholder_text = editor.getElement().getAttribute("placeholder") || editor.settings.placeholder;
                var placeholder_attrs = editor.settings.placeholder_attrs || { style: { position: 'absolute', top: '2px', left: 0, color: '#aaaaaa', padding: '.25%', margin: '5px', width: '80%', 'font-size': '17px !important;', overflow: 'hidden', 'white-space': 'pre-wrap' } };
                var contentAreaContainer = editor.getContentAreaContainer();
                tinymce.DOM.setStyle(contentAreaContainer, 'position', 'relative');
                this.el = tinymce.DOM.add(contentAreaContainer, "label", placeholder_attrs, placeholder_text);
            }
            Label.prototype.hide = function () { tinymce.DOM.setStyle(this.el, 'display', 'none'); }
            Label.prototype.show = function () { tinymce.DOM.setStyle(this.el, 'display', ''); }
        });

        tinymce.init({
          selector: ".section_description",
          plugins: ["placeholder"],
          height : 200,
          elementpath: false,
          menubar: false,
          plugins: 'lists advlist'
        });

    </script>
  </body>
</html>
