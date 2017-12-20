<?php
session_start();

//FOR TESTING:  ADD A FICTIONAL USER
//$_SESSION['user_id']=1;//pretend user 1 is logged in
//$_SESSION['user_not_expired']=true; //pretend user account is not expired
//$_SESSION['admin']=true;  //pretend user is an admin

//var_dump($_SESSION);

ob_start();//turn output buffering on


function __autoload($class) {
    require_once 'classes/' . $class . '.php';
}

//instantiate the database handler
$dbh = new DbHandler();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>GradTracker</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<!-- Logout Page Template Content -->
<body class="bg-dark">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Logout</div>
        <div class="card-body">
    
    
    <?php
    
        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], 
                $params["domain"],
                $params["secure"], 
                $params["httponly"]
            );
        }

        // Finally, destroy the session.
        
        session_destroy();
        
        ?>
    
    <div class="alert alert-success" role="alert">
        Thank you for visiting. You are now logged out. <br>
        Please come back soon.<br>
            <a href="index.php">Back to Home</a>
        
    </div>
    
      <?php
//    header('Location: index.php');
//    ?>
    
    <script>
            var delay = 5 ;
            var url = 'logout.php';
            function countdown() {
                    setTimeout(countdown, 1000) ;
                    $('#count').html(delay);
                    delay --;
                    if (delay < 0 ) {
                            window.location = url ;
                            delay = 0 ;
                    }
            }
            countdown() ;   
          </script>
          
</div>
<!-- /.container -->
