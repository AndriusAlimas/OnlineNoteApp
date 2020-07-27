<?php
session_start();
include("connection.php");

// get the id of the note sent through Ajax
        $id = $_POST['id']; // see post method part of data

// get the content of the note
        $note = $_POST['note'];

// get the time
        $time = time();

// run a query to update the note
        $sql = "UPDATE `notes` SET `note`='$note', `time`='$time' WHERE `id`='$id'";

        $result = mysqli_query($connect,$sql);

        if(!$result){
            echo 'error'; // ajax call, see data=='error'

        }

// we need close a connection, if its still opened
if (isset($connect)) {
    mysqli_close($connect);
}
?>