$('.create_section').on('click', function(event){
  function getUrlVars()//get the class id from url
  {
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++)
      {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
      }
      return vars;
  }

var class_id = getUrlVars()["class"];// GET

var saveButt = $(event.target).parent();//get the inputs VALUES
var input = saveButt.parent().prev().parent().find('.editSectionName');

var data = {};
for (var i = 0; i < input.length; i++) {
  data[$(input[i]).attr("name")] = $(input[i]).val();
}

//add tinymac content
data['section_description'] = tinyMCE.activeEditor.getContent();

//NOW SENDING to PHP FILE
$.ajax({
    type: 'POST',
    url: 'include/create-section.php?class=' + escape(class_id),//sending get vars in url
    data: data,
    success: function(response) {

      console.log(response);

      if(response == 1){
        history.go(-1);
      }
        $('.view-section').find('.error-message').hide();
        $('.view-section').find('.error-message').addClass('soft-warning').html(response).slideDown();


    }
});//end of ajax


});
