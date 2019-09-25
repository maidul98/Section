
//NAV USER ICON
    $(".userPic").click(function(event){
        event.stopPropagation();
        $(".userDropDown").fadeToggle();
    });

    $(document).click(function(){
      $('.userDropDown').hide();
    });

//Save rubric

$('.enterRubricDescription').on('keyup',function(){
  var input = $(this);
  var loadBar = input.next()
  $(loadBar).show();

  setTimeout(function () {
    $(loadBar).hide();
  }, 1000);

});


//sections page
$('.section-list p').hover(function(){
  $(this).addClass( "hover-class-name" );
});

$('.section-list p').hover(
       function(){ $(this).addClass('hover-class-name') },
       function(){ $(this).removeClass('hover-class-name') }
);

$('.addClassButton').on('click', function(){
  $('.enter-class-details').toggle();
});

// //adding active nav
// $(function(){
//
//     var url = window.location.pathname,
//         urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
//         // now grab every link from the navigation
//         $('.navbar').find('a').each(function(){
//             // and test its normalized href against the url pathname regexp
//             if(urlRegExp.test(this.href.replace(/\/$/,''))){
//                 $(this).find('li').addClass('activeNav');
//             }
//         });
//
// });

//function to do text selecting
function SelectText(element) {
    var doc = document
        , text = doc.getElementById(element)
        , range, selection
    ;
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}

//text select class code
    $( "#class-code-number" ).mouseover(function() {
      $(this).css("cursor", "pointer");
      SelectText('class-code-number');
    });
