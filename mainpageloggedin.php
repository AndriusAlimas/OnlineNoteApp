<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}else{
    include ('connection.php');

    $user_id = $_SESSION['user_id'];

    // get username
    $sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";

    $result = mysqli_query($connect,$sql);

    $count = mysqli_num_rows($result);

    if($count == 1){
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $username = $row['username'];
    }else{
        echo "There was an error retrieving the username from the database";
    }

    if(isset($connect)){
        mysqli_close($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>My Notes</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styling.css" rel="stylesheet">  
      
    <!--Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
      
    <style>
        #container{
            margin-top: 120px;
        }  
        
        #allNotes, #done, #notePad , .delete{
            display: none;
        }
        
        .buttons{
            margin-bottom: 20px;
        }
        
        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: #CA3DD9;
            color: #CA3DD9;
            background-color: #FBEFFF;
            padding: 10px;
        }

        .noteHeader{
            border: 1px solid grey;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            padding: 0 10px;
            background: linear-gradient(#FFFFFF,#ECEAE7);
            background: -moz-linear-gradient(#FFFFFF,#ECEAE7);
            background: -o-linear-gradient(#FFFFFF,#ECEAE7);
            background: -ms-linear-gradient(#FFFFFF,#ECEAE7);
            background: -webkit-linear-gradient(#FFFFFF,#ECEAE7);
        }
        .text{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .timeText{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

    </style>  
  </head>
  <body>
    <!-- Navigation Bar -->  
      <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Online Notes</a>
                <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>  
            <div id="navbarCollapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li class="active" ><a  href="#">My Notes</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Logged in as <strong><?php echo  $username;?></strong></a></li>
                        <li><a href="index.php?logout=1">Log out</a></li>
                    </ul>
            </div>
        </div>
      </nav>
      
    <!-- Main Container -->  
        <div id="container">
            <!-- Alert Message-->
            <div id="alert" class="alert alert-danger collapse">
                <a class="close" data-dismiss="alert" >
                    &times;
                </a>
                <p id="alertContent"></p>
            </div>

            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="buttons">
                        <button type="button" id="addNote" class="btn btn-info btn-lg">Add Note</button>
                        <button type="button" id="edit" class="btn btn-info btn-lg pull-right">Edit</button>
                        <button type="button" id="done" class="btn green btn-lg pull-right">Done</button>
                        <button type="button" id="allNotes" class="btn btn-info btn-lg">All Notes</button>
                    </div>
                <!-- TEXT AREA where you write your notes          -->
                    <div id="notePad">
                        <textarea rows="10">
                        
                        </textarea>
                    </div>
                    
                    <div id="notes" class="notes">
                    <!-- AJAX call to a php file                        -->
                    </div>
                </div>
            </div>
        </div>
      
    <!-- Footer -->  
      <div class="footer">
          <div class="container">
            <p>Developed by &copy; Andrius Alimas 2020 April - <?php $today = date("Y M"); echo $today;?>.</p>
          </div>
      </div>

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.5.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mynotes.js"></script>
  </body>
</html>