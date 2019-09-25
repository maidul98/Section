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


//make sure user can only see class they created
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
        <h3 class="class-title">Sections in <?php print(ucfirst($class_info['class_title'])) ?></h3>
        <a href="new-section.php?class=<?php print_r($_GET['class']) ?>"><button class="create-new new-section loginSubmit">New</button></a>
        <div class="cf"></div>
          <div id="section-tabs">
        <?php
        //get the info from section table
        $query = "SELECT * FROM section WHERE class_code='".$class_info['class_code']."'";
        $result = mysqli_query($mysqli, $query);
        $num_sections = mysqli_num_rows($result);
        if($num_sections){
        while($section_info = mysqli_fetch_array($result)){
              echo '<section  data-section="'.$section_info['section_id'].'">
              		<header class="open-section" id="outer">
              			<input class="editSectionName cat" id="section-title" name="section_name" placeholder="Enter section title" readonly type="text" value="'.$section_info['section_name'].'">
              		</header>
              		<div class="content">
              			<table class="basicTable">
              				<tr>
              					<td>Learning target</td>
              					<td><input class="editSectionName" id="create-learning-target" name="section_lt" placeholder="Learning target" type="text" value="'.$section_info['section_lt'].'"></td>
              				</tr>
              				<tr>
              					<td>When is this section due?</td>
              					<td><input class="editSectionName" id="section-due-date" name="due_date" type="date" value="'.$section_info['due_date'].'"></td>
              				</tr>
              			</table><!-- rubric -->
                    <textarea class="editSectionName section_description" id="section-des" name="section_description" placeholder="Details on section">'.$section_info['section_description'].'</textarea>
              			<div class="studentRubric">
              				<span class="moreInfoTitle">Rubric</span>
              				<div class="row rubricBg">
              					<div class="col exem rubricBox">
              					<p class="exemplaryColor gradeTitle">Exemplary</p>
              					<textarea class="enterRubricDescription editSectionName" name="exemplary">'.$section_info['exemplary'].'</textarea></div>
              					<div class="col acco rubricBox">
              					<p class="accomplishedColor gradeTitle">Accomplished</p>
              					<textarea class="enterRubricDescription editSectionName" name="accomplished">'.$section_info['accomplished'].'</textarea></div>
              					<div class="col comp rubricBox">
              					<p class="competentColor gradeTitle">Competent</p>
              					<textarea class="enterRubricDescription editSectionName" name="competent">'.$section_info['competent'].'</textarea></div>
              					<div class="col noMas rubricBox">
              						<p class="nomasColor gradeTitle">No Mastery</p>
              						<div class="editRubric">
              						<textarea class="enterRubricDescription editSectionName" name="no_mastery">'.$section_info['no_mastery'].'</textarea></div>
              					</div>
              					<div class="cf"></div><!-- save button -->
              					<button class="save loginSubmit">Save</button>
                        <div class="saved-success pull-left"></div>
                        <button class="delete loginSubmit">Delete</button>
              					<div class="cf"></div>
              				</div>
              				<div class="cf"></div>
              			</div><!--END OF RUBRIC-->
              		</div>
              	</section>';
            }
          }else{
            info_warning('You do not have any active sections');
          }
         ?>

        </div>
        </div>
      </div>
  </div>
    <?php include 'footer.php' ?>
    <script src="js/update-section.js"></script>
    <script src="js/sections.js"></script>
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
          height : 200,
          elementpath: false,
          plugins: 'lists advlist table textcolor colorpicker placeholder ',
          menu: {
  table: {title: 'Insert Table', items: 'inserttable tableprops deletetable | cell row column'},
}
        });
    </script>
  </body>
</html>
