<?php
// Start session
session_start();

// Connect to the database
include("connection.php");

// Check user inputs
//         Define error messages
        $missingEmail = '<p><strong>Please enter your email address!<strong></p>';
        $invalidEmail = '<p><strong>Please enter a valid email address!<strong></p>';
        $errors ="";

    //         Get email
    //         Store errors in errors variable
        if(empty($_POST["forgotEmail"])){
            $errors .= $missingEmail;
        }else{
            $email = filter_var($_POST["forgotEmail"],FILTER_SANITIZE_EMAIL);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors .= $invalidEmail;
            }
        }

//     If there are any errors print error
        if($errors){ //    print error message
            $resultMessage = '<div class="alert alert-danger">' . $errors. '</div>';
            echo $resultMessage;
            exit;
        }
        // No errors

         //  Prepare variables for the queries
                $email = mysqli_real_escape_string($connect,$email);

//             Run query: Check if the email exists in the users table
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($connect,$sql);

                    if(!$result){
                        echo '<div class="alert alert-danger">Error running the query!</div>';
                        exit;
                    }

    //         If the email does not exist
    //             print error message
                    $count = mysqli_num_rows($result);
                    if($count != 1){
                        echo '<div class="alert alert-danger">That email is not exist on our database!.</div>';
                        exit; // stop
                    }
//         else
//             get the user_id
                    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $user_id = $row['user_id'];

//             Create a unique activation code
                        $key = bin2hex(openssl_random_pseudo_bytes(16));

//             Insert user details and activation code in the forgotpassword table
                        $time = time();
                        $status = 'pending';

                        $sql = "INSERT INTO forgotpassword (`user_id`, `reset_key`, `time`, `status`) VALUES ('$user_id', '$key', '$time', '$status')";
                        $result = mysqli_query($connect,$sql);

                if(!$result){
                    echo '<div class="alert alert-danger">There was an error inserting the users details in the database! </div>';
                    exit;
                }

//             Send email with link to resetpassword.php with user id and activation code
                    $message = "Please click on this link to reset your password:\n\n";
                    $message .= "https://alimas.host20.uk/WEB/9.Online%20Notes%20App(HTML,CSS,Bootstrap,PHP,MySQL,AJAX)/resetpassword.php?user_id=$user_id&key=$key";

                    if(mail($email, 'Reset your password',$message,'From:'.'andriusjavait@gmail.com')){
                        // If email sent successfully
                                    // print success message
                        echo '<div class="alert alert-success">An email has been sent to  $email. Please click on the link to reset your password. </div>';
                    }

// we need close a connection, if its still opened
if (isset($connect)) {
    mysqli_close($connect);
}
?>