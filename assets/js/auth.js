$(document).ready(function () {
    // login
    $(document).on("click", "#btnLogIn", function (e) {
      e.preventDefault();
      console.log('radi')
      let email = $('#email').val()
      let password = $('#password').val()
  
      if(loginValidation(email, password).length == 0){
        $.ajax({
          type: "post",
          url: "models/auth/login.php",
          data: {email, password},
          dataType: "json",
          success: function (response) {
            if(response == 2){
              window.location.href= 'admin.php'
            }else{
              window.location.href='index.php'
            }
          },error:function(jqXHR,statusTxt,xhr){
            responseMessage(jqXHR.responseJSON, 'danger', 'login-message')
          }
        });
      }
  
    });
  
    function loginValidation(email, password){
      let errors = []
      const reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
      const rePassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
      inputValidation(email, reEmail, errors, "email-error", "Email isn't valid")
      inputValidation(password, rePassword, errors, "password-error","Password isn't valid")
      return errors
    }
    // register
  
    $(document).on("click", "#btnRegister", function (e) {
      e.preventDefault();
      
      const first_name = $('#first-name').val()
      const last_name = $('#last-name').val()
      const email = $('#email').val()
      const password = $('#password').val()
  
      if(registerFormValidation(first_name, last_name, email, password).length  == 0 ){
        $.ajax({
          type: "post",
          url: "models/auth/register.php",
          data: {first_name, last_name, email, password},
          dataType: "json",
          success: function (response) {
            window.location.href = 'index.php'
          },error:function(jqXHR,statusTxt,xhr){
           responseMessage(jqXHR.responseJSON, 'danger','register-message')
          }
        });
      }
  
    });
    function registerFormValidation(first_name, last_name, email, password) {
      let errors = [];
      const reFirstLastName = /^[A-Z][a-z]{1,}(\s[A-Z][a-z]{1,})?$/;
      const reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
      const rePassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
  
      inputValidation(first_name, reFirstLastName, errors, "first-name-error","First name isn't valid")
      inputValidation(last_name, reFirstLastName, errors, "last-name-error","Last name isn't valid")
      inputValidation(email, reEmail, errors, "email-error","Email isn't valid")
      inputValidation(password, rePassword, errors, "password-error","Password isn't valid")
  
      return errors
  
    }
  });
  