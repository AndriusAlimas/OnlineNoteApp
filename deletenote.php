<?php
session_start();
include("connection.php");

// get the id of the note through Ajax
    $note_id = $_POST['id'];

// run a query to delete the note
    $sql = "DELETE FROM `notes` WHERE `id`='$note_id'";

    $result = mysqli_query($connect,$sql);

    if(!$result){
        echo 'error';
    }

// we need close a connection, if its still opened
if (isset($connect)) {
    mysqli_close($connect);
}
?>