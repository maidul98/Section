//check wheater if studnet or teacher

$('#login-or-studnet').click(function(e){
  var user_type = $('input[name=type-of-user]:checked').val();
  if(user_type == 'student'){
      event.preventDefault();
    $('.student-or-teacher').hide();
    $('.create_account').fadeIn();
    $('.breadcrumb').fadeIn();
  }

  if(user_type == 'teacher'){
      event.preventDefault();
    $('.student-or-teacher').hide();
    $('.create_account_teacher').fadeIn();
  }
});

// teacher-register

$('#teacher-register').click(function(event){
  var error = false;
  var email = $('#email').val();
  var password = $('#password').val();
  var name = $('#name').val();
// //checking email
  if(email === ""){
    $('.email_register').addClass('addRedBorder');
    error = true;
  }else {
    $('.email_register').removeClass('addRedBorder');
  }
//
// //checking password
  if(password == ""){
    $('.password_register').addClass('addRedBorder');
    error = true;
  }else {
    $('.password_register').removeClass('addRedBorder');
  }
// //checking name
  if(name == ""){
    $('.name_register').addClass('addRedBorder');
    error = true;
  }else {
    $('.name_register').removeClass('addRedBorder');
  }
//
//if no error on the first page
  if(error){
      event.preventDefault();
}

});

// check class code beofre submiting

  $('#login_submit').click(function(event){
    var error = false;
    var code = $('#code').val();
    if(code == ""){
      $('.code_register').addClass('addRedBorder');
      error = true;
      event.preventDefault();
    }else {
      $('.code_register').removeClass('addRedBorder');
    }
  });

// //password meter
// document.querySelector('#password').addEventListener('input', function(){
//   var password = $('#password').val();
//   var confpassword = $('#comfpassword').val()
//   //if the password is weak
//   if( password != confpassword ){
//     document.querySelector('.passMeter').innerHTML = 'Diffrent';
//     $('.passMeter').addClass('weakPassword');
//   }else{
//     // $('.passMeter').removeClass('weakPassword');
//     document.querySelector('.passMeter').innerHTML = 'Perfect';
//     $('.passMeter').addClass('strongPassword');
//   }
//
// });

// //regester-studnet
  document.querySelector('#next_register').addEventListener('click', function(event){
  var error = false;
  var email = $('#email').val();
  var password = $('#password').val();
  var name = $('#name').val();
// //checking email
  if(email === ""){
    $('.email_register').addClass('addRedBorder');
    error = true;
  }else {
    $('.email_register').removeClass('addRedBorder');
  }
//
// //checking password
  if(password == ""){
    $('.password_register').addClass('addRedBorder');
    error = true;
  }else {
    $('.password_register').removeClass('addRedBorder');
  }
// //checking name
  if(name == ""){
    $('.name_register').addClass('addRedBorder');
    error = true;
  }else {
    $('.name_register').removeClass('addRedBorder');
  }
//
//if no error on the first page
  if(!error){
    $('.create_account').hide();
    $('.class_code').fadeIn();
    $('#errors-list').remove();
  }
});
