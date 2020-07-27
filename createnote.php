<?php
session_start();
include("connection.php");

// get the user_id
    $user_id = $_SESSION['user_id'];

// get the current time
    $time = time();

// run a query to create new note
    $sql = "INSERT INTO `notes` (`user_id`, `note`, `time`)
            VALUES ('$user_id', '', '$time')";

    $result = mysqli_query($connect,$sql);

    if(!$result){
     echo 'error'; // call ajax
    }else{
        // mysqli_insert_id() returns the auto generated id used in the last query
        echo mysqli_insert_id($connect); // call ajax , get id
    }

// we need close a connection, if its still opened
if (isset($connect)) {
    mysqli_close($connect);
}
?>