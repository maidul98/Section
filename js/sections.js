$(document).ready(function(e) {
  $('section > header').on('click', function(e){//when the header is cliked
    if(e.target.id == 'outer'){//if you click only the tab
      $(this).next().slideToggle();//toggle the content box
      $(this).toggleClass('section-tab-active');//when  clicked active
      $(this).toggleClass('close-section');//when close icon
      $(this).find('input').toggleClass('edit-section-name');//show the pen icon
    }
  });
  $('section > header > input').on('click', function(e){//when the tab is open with class active
    parent = $(e.target).parent();
    if(parent.hasClass('section-tab-active')){
      $(this).removeProp('readonly');//then remove the read only
    }
  });

  $('section > header').on('click', function(e){//when the header is cliked
    if(e.target.id == 'outer'){//if you click only the tab
      $(this).find('input').prop('readonly', true);
    }
  });

  //if the id of the header is active, and if the user clicks the input than remove readonly

});
