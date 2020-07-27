<?php
    // start session and connect
    session_start();
    include ("connection.php");

    // get user_id and new email sent through Ajax call
    $user_id = $_SESSION['user_id'];
    $newEmail = $_POST['email'];

    // check if new email exists
    $sql ="SELECT `email` FROM `users` WHERE `email`='$newEmail'";
    $result = mysqli_query($connect,$sql);

    if(!$result){
        echo "<div class='alert alert-danger'>Error running the query!</div>";
        exit;
    }

    $count = mysqli_num_rows($result);

    if($count > 0){
        echo "<div class='alert alert-danger'>There is already as user registered with that email!
                Please choose another one!</div>"; exit;
    }

    // get the current email
        $sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";

        $result = mysqli_query($connect,$sql);

        $count = mysqli_num_rows($result);

        if($count == 1){
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $email = $row['email'];
        }else{
            echo "There was an error retrieving  email from the database"; exit;
        }

    // create a unique activation code
        $activationKey = bin2hex(openssl_random_pseudo_bytes(16));

    // insert new activation code in the users table
        $sql ="UPDATE `users` SET `activation2`='$activationKey' WHERE `user_id`='$user_id'";
        $result = mysqli_query($connect,$sql);

        if(!$result){
            echo "<div class='alert alert-danger'>There was an error inserting the user details in the database.</div>";
        }else{
            // send email with link to activatenewemail.php with current email, new email and activation code
            $message = "Please click on this link to prove that you own this email:\n\n";
            $message .= "https://alimas.host20.uk/WEB/9.Online%20Notes%20App(HTML,CSS,Bootstrap,PHP,MySQL,AJAX)/activatenewemail.php?email=" .
                urlencode($email) ."&newEmail=".urlencode($newEmail)."&key=$activationKey";

            if(mail($newEmail, 'Email Update for your Online Notes App',$message,'From:'.'andriusjavait@gmail.com')){
                echo '<div class="alert alert-success">An email has been sent to '. $newEmail . '. Please click on the link to prove you own that email address.</div>';
            }
        }

    if(isset($connect)){
        mysqli_close($connect);
    }
?>