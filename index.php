<?php
session_start();

// connect to DB
include("connection.php");

// logout
include("logout.php");

// remember me
include('remember.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Online Notes</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styling.css" rel="stylesheet">  
      
    <!--Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
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
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#loginModal" data-toggle="modal">Login</a></li>
                    </ul>
            </div>
        </div>
      </nav>
      
    <!-- Jumbotron with Sign up Button -->  
      <div class="jumbotron" id="myContainer">
        <h1>Online Note App</h1>
          <p>Your Notes with you wherever you go.</p>
          <p>Easy to use, protects all your notes!</p>
          <button type="button" class="btn btn-lg green signup" data-target="#signupModal" data-toggle="modal">Sign up-It's free</button>
      </div>
      
    <!-- Login Form -->  
        <form  method="post" id="loginForm">
            <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h4>Login:</h4>
                        </div>    
                        <div class="modal-body">
                        <!-- Login message from PHP file-->    
                           <div id="loginMessage">
                            
                           </div>
                               <!-- Email input -->
                             <div class="form-group">
                               <label for="loginEmail" class="sr-only">Email:</label>
                                <input class="form-control" type="email" name="loginEmail" id="loginEmail" placeholder="Email" maxlength="50">
                             </div>     
                               <!-- Password inputs -->
                            <div class="form-group">
                               <label for="loginPassword" class="sr-only">Password:</label>
                                <input class="form-control" type="password" name="loginPassword" id="loginPassword" placeholder="Password" maxlength="30">
                            </div>
                            <div class="checkbox">
                                <label for="rememberMe">
                                    <input type="checkbox" name="rememberMe" id="rememberMe">
                                    Remember me
                                </label>
                             <a data-target="#forgotPasswordModal" data-toggle="modal" class="pull-right" 
                                style="cursor:pointer" data-dismiss="modal">
                             Forgot Password?
                            </a>
                         </div>
                     </div>    
                        <div class="modal-footer">
                            <input class="btn green" name="login" type="submit" value="Login">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">Register</button>
                        </div>    
                  </div>
              </div>
          </div>
      </form>
      
    <!-- Sign Up Form --> 
      <form  method="post" id="signupForm">
            <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h4>Sign up today and Start using our Online Notes App!</h4>
                        </div>    
                        <div class="modal-body">
                         <!-- Sign up message from PHP file-->    
                           <div id="signupMessage">
                            
                           </div>
                             <!-- Username input -->
                           <div class="form-group">
                               <label for="username" class="sr-only">Username:</label>
                                <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
                            </div>   
                               <!-- Email input -->
                             <div class="form-group">
                               <label for="signupEmail" class="sr-only">Email:</label>
                                <input class="form-control" type="email" name="signupEmail" id="signupEmail" placeholder="Email Address" maxlength="50">
                             </div>     
                               <!-- Password inputs -->
                            <div class="form-group">
                               <label for="signupPassword" class="sr-only">Choose a password:</label>
                                <input class="form-control" type="password" name="signupPassword" id="signupPassword" placeholder="Choose a password" maxlength="30">
                            </div>   
                            <div class="form-group">
                               <label for="signupPasswordR" class="sr-only">Confirm password:</label>
                                <input class="form-control" type="password" name="signupPasswordR" id="signupPasswordR" placeholder="Confirm a password" maxlength="30">
                            </div>
                        </div>    
                        <div class="modal-footer">
                            <input class="btn green" name="signup" type="submit" value="Sign up">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>    
                  </div>
              </div>
          </div>
      </form>
      
    <!-- Forgot Password Form -->  
       <form  method="post" id="forgotPasswordForm">
            <div class="modal" id="forgotPasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h4>Forgot Password?Enter your email address:</h4>
                        </div>    
                        <div class="modal-body">
                        <!-- Forgot Password message from PHP file-->    
                           <div id="forgotPasswordMessage">
                            
                           </div>
                               <!-- Email input -->
                             <div class="form-group">
                               <label for="forgotEmail" class="sr-only">Email:</label>
                                <input class="form-control" type="email" name="forgotEmail" id="forgotEmail" placeholder="Email" maxlength="50">
                             </div>     
                        </div>    
                        <div class="modal-footer">
                            <input class="btn green" name="forgotPassword" type="submit" value="Submit">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">Register</button>
                        </div>    
                  </div>
              </div>
          </div>
      </form>
      
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
    <script src="js/index.js"></script>
  </body>
</html>
<?php
// we need close a connection, if its still opened
if (isset($connect)) {
    mysqli_close($connect);
}
?>
