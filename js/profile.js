// Ajax call to updateusername.php
$("#updateUsernameForm").submit(function(event){
    // prevent default php processing
    event.preventDefault();

    // collect user input
    var datapost = $(this).serializeArray();

    // send them to updateusername.php using AJAX
    $.ajax({
        url: "updateusername.php",
        type: "POST",
        data: datapost,

        // AJAX Call successful: show error or success message
        success: function(data){
            if(data){
                $("#updateUsernameMessage").html(data);
            }else{
                location.reload();
            }
        },
        error: function(){
            // AJAX Call fails: show Ajax Call error
            $("#updateUsernameMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call.Please try again later.</div>");
        }
    });
});

// Ajax call to updatepassword.php
$("#updatePasswordForm").submit(function(event){
    // prevent default php processing
    event.preventDefault();

    // collect user input
    var datapost = $(this).serializeArray();

    // send them to updatepassword.php using AJAX
    $.ajax({
        url: "updatepassword.php",
        type: "POST",
        data: datapost,

        // AJAX Call successful: show error or success message
        success: function(data){
            if(data){
                $("#updatePasswordMessage").html(data);
            }
        },
        error: function(){
            // AJAX Call fails: show Ajax Call error
            $("#updatePasswordMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call.Please try again later.</div>");
        }
    });
});

// Ajax call to updateemail.php
$("#updateEmailForm").submit(function(event){
    // prevent default php processing
    event.preventDefault();

    // collect user input
    var datapost = $(this).serializeArray();

    // send them to updateemail.php using AJAX
    $.ajax({
        url: "updateemail.php",
        type: "POST",
        data: datapost,

        // AJAX Call successful: show error or success message
        success: function(data){
            if(data){
                $("#updateEmailMessage").html(data);
            }
        },
        error: function(){
            // AJAX Call fails: show Ajax Call error
            $("#updateEmailMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call.Please try again later.</div>");
        }
    });
});