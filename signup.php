<?php
    // Start session 
    session_start();

    //Connect to the database 
   include('connection.php');

//  Define errors messages
    $missingUserName = '<p><strong>Please enter a username!<strong></p>';
    $missingEmail = '<p><strong>Please enter your email address!<strong></p>';
    $invalidEmail = '<p><strong>Please enter a valid email address!<strong></p>';
    $missingPassword = '<p><strong>Please enter a Password!<strong></p>';
    $invalidPassword = '<p><strong>Your passsword should be at least 6 characters
    long and include one capital letter and one number!<strong></p>';
    $differentPassword = '<p><strong>Password don\'t match!<strong></p>';
    $missingPassword2  = '<p><strong>Please confirm your password<strong></p>';

    // result message:
    $errors ="";
    //  Check user inputs
  // Store errors in errors variable 
            //  Get:
                // username
                    if(empty($_POST["username"])){
                        $errors .= $missingUserName;
                    }else{
                        $username = filter_var($_POST["username"],FILTER_SANITIZE_STRING);
                    }

                // email 
                    if(empty($_POST["signupEmail"])){
                        $errors .= $missingEmail;
                    }else{
                        $email = filter_var($_POST["signupEmail"],FILTER_SANITIZE_EMAIL);
                        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                            $errors .= $invalidEmail;
                        }
                    }

                // password
                    if(empty($_POST["signupPassword"])){
                        $errors .= $missingPassword;
                      // check password length is not less than 6 characters and password include at least one capital letter   
                    }elseif(!(strlen($_POST["signupPassword"])>5 and preg_match('/[A-Z]/',$_POST["signupPassword"])
                           and preg_match('/[0-9]/',$_POST["signupPassword"])  // password must include at least one number
                           )   
                    ){ 
                        $errors .= $invalidPassword;
                    }else{
                        $password = filter_var($_POST["signupPassword"],FILTER_SANITIZE_STRING);
                        
                        // password2 is missing?
                        if(empty($_POST["signupPasswordR"])){
                            $errors .= $missingPassword2;
                        }else{
                            $password2 = filter_var($_POST["signupPasswordR"],FILTER_SANITIZE_STRING);

                            // password2 are same as password?
                            if(strcmp($password,$password2)){
                                $errors .= $differentPassword;
                            }
                        }
                    }
//                  If there are any errors print error 
                        if($errors){
                            $resultMessage = '<div class="alert alert-danger">' . $errors. '</div>';
                            echo $resultMessage;
                            exit;
                        }
// No errors
//     Prepare variables for the queries
        $username = mysqli_real_escape_string($connect,$username);
        $email = mysqli_real_escape_string($connect,$email);
        $password = mysqli_real_escape_string($connect,$password);

//        $password = md5($password);
        $password = hash('sha256',$password);                                            
        // 128bits -> 32 characters
        // 256 bits -> 64 characters

//  If username exists in the users table print error
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connect,$sql);

        if(!$result){
            echo '<div class="alert alert-danger">Error running the query!</div>';
            exit;
        }

        $results = mysqli_num_rows($result);
        if($results){
            echo '<div class="alert alert-danger">That username is already registered. Do you want to log in?</div>';
            exit; // stop
        }

//       else  If email exists in the users table print error 
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connect,$sql);

        if(!$result){
            echo '<div class="alert alert-danger">Error running the query!</div>';
            exit;
        }

        $results = mysqli_num_rows($result);
        if($results){
            echo '<div class="alert alert-danger">That email is already registered. Do you want to log in?</div>';
            exit;
        }

//             Create a unique activation code
                    $activationKey = bin2hex(openssl_random_pseudo_bytes(16));
            // byte: unit of data = 8 bits
            // bit: 0 or 1
            // 16 bytes = 16* 8 = 128 bits
            // (2*2*2*2)*2*2*2*2*2*2*2*2*....*2
            // 16 * 16* ...*16
            // 32 characters

//              Insert user details and activation code in the users table
            $sql = "INSERT INTO users (
                username, email, password, activation) VALUES('$username', '$email', '$password', '$activationKey')";

              $result = mysqli_query($connect,$sql);
        
              if(!$result){
                   echo '<div class="alert alert-danger">There was an error inserting the users details in the database! </div>';
                   echo '<div class="alert alert-danger">'. mysqli_error($connect) .'</div>';
                  exit;
              }

//      Send the user an email with a link to activate. php with their email and activation code
        $message = "Please click on this link to activate your account:\n\n";
        $message .= "https://alimas.host20.uk/WEB/9.Online%20Notes%20App(HTML,CSS,Bootstrap,PHP,MySQL,AJAX)/activate.php?email=" .
            urlencode($email) ."&key=$activationKey";

        if(mail($email, 'Confirm your Registration',$message,'From:'.'andriusjavait@gmail.com')){
           echo '<div class="alert alert-success">Thank for your registring! A confirmation email has been sent to '. $email . '. Please click on the activation link to activate your account.</div>';
        }

// we need close a connection, if its still opened
if (isset($connect)) {
    mysqli_close($connect);
}
?>

