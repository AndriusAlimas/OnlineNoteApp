// Ajax Call for the sign up form 
    // Once the form is submitted
    $("#signupForm").submit(function(event){
         // prevent default php processing
        event.preventDefault();

        // collect user input
        var datapost = $(this).serializeArray();

        // send them to signup.php using AJAX
        $.ajax({
            url: "signup.php",
            type: "POST",
            data: datapost,

             // AJAX Call successful: show error or success message
            success: function(data){
               if(data){
                    $("#signupMessage").html(data);
               }
            },
            error: function(){
                 // AJAX Call fails: show Ajax Call error
                $("#signupMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call.Please try again later.</div>");
            }
        });
//        $.post({}).done().fail();
    });

// Ajax Call for the login form
    // Once the form is submitted
    $("#loginForm").submit(function(event){
         // prevent default php processing
        event.preventDefault();
        // collect user input
        var datapost = $(this).serializeArray();
        
        // send them to login.php using AJAX
        $.ajax({
            url: "login.php",
            type: "POST",
            data: datapost,
             // AJAX Call successful
            // if php files returns "success": redirect the user to notes page
            // otherwise show error message
            success: function(data){
               if(data.trim() == "success"){
                    window.location = "mainpageloggedin.php"
               }else{
                   $('#loginMessage').html(data);
               }
            },
            // AJAX Call fails: show Ajax Call error
            error: function(){
                $("#loginMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call.Please try again later.</div>");
            }
        });
    });

// Ajax Call for the forgot password form
// Once the form is submitted
$("#forgotPasswordForm").submit(function(event){
    // prevent default php processing
    event.preventDefault();

    // collect user input
    var datapost = $(this).serializeArray();

    // send them to forgot-password.php using AJAX
    $.ajax({
        url: "forgot-password.php",
        type: "POST",
        data: datapost,
        success: function(data){
            // AJAX Call successful: show error or success message
                $('#forgotPasswordMessage').html(data);
                },
        // AJAX Call fails: show Ajax Call error
        error: function(){
            $("#forgotPasswordMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call.Please try again later.</div>");
        }
    });
});