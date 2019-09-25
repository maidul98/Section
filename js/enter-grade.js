$('.save').on('click', function(event){

//get the class code and student is from url
function getUrlVars()
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


var student_id = getUrlVars()["student"];
var class_code = getUrlVars()["class"];

var number_checked = $('.basicTable input:checked').size();

var selected = {};
for( var i = 0; i<number_checked; i++){
  selected[$('.basicTable input:checked').eq(i).attr("name")] = $('.basicTable input:checked').eq(i).val();
}

console.log(selected);
//NOW SENDING to PHP FILE
$.ajax({
    type: 'POST',
    url: 'include/add-grade.php?class=' + escape(class_code) + '&student=' + escape(student_id),//sending get vars in url
    data: selected,
    success: function(response) {
      $('.enter-grades').find('.saved-success').slideDown();
      $('.enter-grades').find('.saved-success').html(response);
      setTimeout(function(){
        $('.enter-grades').find('.saved-success').slideUp();
      }, 3000);
    }
});//end of ajax


});
