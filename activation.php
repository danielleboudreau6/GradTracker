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


    if (isset($_GET['x']) && isset($_GET['y'])){
    //good to go
    //Retrieve url params
    $email = $_GET['x'];
    $active = $_GET['y'];
    //var_dump($email);
    //var_dump($active);
    
    $errors = array();
    //validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email address!';
    }   
    
    //validate activation code
    if (strlen($active)!=32) {
       $errors['active'] = 'Invalid activation code!';
    }
    
    //var_dump($errors);
    if (empty($errors)) {
        //ok to proceed - update database
       $data = $dbh->activateUser($email,$active);
       //var_dump($data);
       //exit();
       if($data['error']){
           //Activation Failed 
           echo '<div class="alert alert-danger"><strong>Activation Failed</strong>
                    <p>Account activation has failed!</p>
                </div>';                
          
       }else{
           //Activation Success
           echo '<div class="alert alert-success"><strong>Account Activated</strong>
                    <p>Proceed to the login page!</p>
                    <a class="btn btn-success" href="login.php">Login</a>
                </div>';  
       }
 
        
    }else{
        //Validation Errors: Display Errors
        //var_dump($reg_errors);
        echo '<div class="alert alert-danger">';
            echo '<ul>';
                    foreach($errors as $error){
                        echo "<li>$error</li>";
                    }
            echo '</ul>';
        echo '</div> ';
    }  
             
}else{
    //missing
    echo '<div class="alert alert-danger"><strong>Activation Failed</strong>
            <p>This page has been accessed in error.</p>
         </div>';   
}
?>
</div>





<!--    <form method="post" action="register.php" class="mb-4">
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="firstname">First name</label>
                    <input class="form-control" id="firstname" name="firstname"
                           type="text"  
                           oninvalid="this.setCustomValidity('Please enter first name')" 
                           oninput="setCustomValidity('')"
                           placeholder="Enter first name" required autofocus
                           value="<?php //if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
                </div>
                <div class="col-md-6">
                    <label for="lastname">Last name</label>
                    <input class="form-control" id="lastname" name="lastname"
                           type="text"  
                           oninvalid="this.setCustomValidity('Please enter last name')" 
                           oninput="setCustomValidity('')"
                           placeholder="Enter last name" required
                           value="<?php //if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input class="form-control" id="email" name="email"
                   type="email" oninvalid="this.setCustomValidity('Please enter email')" 
                   oninput="setCustomValidity('')"                   
                   placeholder="Enter email" required
                   value="<?php //if (isset($_POST['email'])) echo $_POST['email']; ?>">
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="password1">Password</label>
                    <input class="form-control" id="password1" name="password1"
                           type="password" 
                           oninvalid="this.setCustomValidity('Please enter password')" 
                           oninput="setCustomValidity('')" autocomplete="off"                  
                           placeholder="Enter password" required>
                </div>
                <div class="col-md-6">
                    <label for="password2">Confirm password</label>
                    <input class="form-control" id="password2" name="password2"
                           type="password" 
                           oninvalid="this.setCustomValidity('Please confirm password')" 
                           oninput="setCustomValidity('')" autocomplete="off"                 
                           placeholder="Confirm password" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form> 
    <div class="mt-4">&nbsp;</div>-->
    
    
    
    
    
<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Account Activation</div>
      <div class="card-body">
        <form action="register.php" method="post">
<!--     <div class="form-row">
          <div class="form-group">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input name="firstname" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name"
                value="<?php //if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input name="lastname" class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name"
                       value="<?php //if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
              </div>
            </div>
          </div>-->
          <div class="form-group">
            <label for="exampleInputEmail1">Activation code</label>
            <input name="email" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter activation code"
                   value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
          </div>
<!--          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input name="password1" class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input name="password2" class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password">
              </div>
            </div>
          </div>-->
          <button type="submit" class="btn btn-primary btn-block">Activate</button>
        </form>
        <div class="text-center">
            <br>
          <a class="d-block small" href="index.php">Back to Home</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
