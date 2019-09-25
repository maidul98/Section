//update sections

$('.save').on('click', function(event){
var saveButt = $(event.target).parent();
var input = saveButt.parent().prev().parent().prev().parent().find('.editSectionName');   //finds out which section to send data update for

var section = saveButt.parent().prev().parent().prev().parent();
var section_id = section.data('section');

var data = {};
for (var i = 0; i < input.length; i++) {
  data[$(input[i]).attr("name")] = $(input[i]).val();
}
//add tinymac content
data['section_description'] = tinyMCE.activeEditor.getContent();

$.ajax({
    type: 'POST',
    url: '/include/update-section.php/?delete-section='+ section_id,
    data: data,
    success: function(response) {
      section.find('.saved-success').slideDown();
      section.find('.saved-success').html(response);
      setTimeout(function(){
        section.find('.saved-success').slideUp();
      }, 3000);
    }
});//end of ajax
});


//delete section
$('.delete').on('click', function(event){

  var saveButt = $(event.target).parent();

  var section = saveButt.parent().prev().parent().prev().parent();
  var section_id = section.data('section');
  data = {};
  data['delete-section'] = section_id;
  if(confirm('Are you sure you want to permanently delete this section?')){//if yes then do this
    $.ajax({
        type: 'POST',
        url: '../include/delete-section.php',
        data: data,
        success: function(response) {
          section.slideUp();
          section.prev().css({"border-bottom-color": "#EBEBEB", "border-bottom-width":"1px", "border-bottom-style":"solid"});
        }
    });//end of ajax

  }
});
