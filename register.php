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


    if ($_POST) {
        
        $reg_errors = array();
        //1.Check for firstname (characters, apos, period, space and dash b/w 2 and 45
        /* rules:  between 2, 45 characters
          letters A-Z, case-insensitive (i)
          space, apostrophe, period, hyphen */
        if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['firstname'])) {
            $firstname = trim($_POST['firstname']);
        } else {
            $reg_errors['firstname'] = 'Please enter your first name!';
        }
        //2. Check for a last name:
        //  rules:  same as first name           
        if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['lastname'])) {
            $lastname = trim($_POST['lastname']);
        } else {
            $reg_errors['lastname'] = 'Please enter your last name!';
        }
        //3. Check for email (valid email address format)
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = trim($_POST['email']);
        } else {
            $reg_errors['email'] = 'Please enter a valid email!';
        }
        // 3.Check for a password and match against the confirmed password:
        /* rules:  
         * - start of the line ^
         * - Password must be 6-40 characters - {6,40} 
         * - Must have no spaces, at least 1 digit (?=.*[\d])
         * - at least 1 uppercase letter (?=.*[A-Z]) 
         * - and at least one lowercase letter (?=.*[a-z]) 
         * - Allows specifying special characters - !@#$%_ 
         * - end of line $        
         */
        if (preg_match('/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])[\w\d!@#$%_]{6,40}$/', $_POST['password1'])) {
            if ($_POST['password1'] == $_POST['password2']) {
                $password2 = strip_tags($_POST['password2']);
            } else {
                $reg_errors['password2'] = 'Your password does not match.';
            }
        } else {
            $reg_errors['password1'] = 'Password must be between 6 and 20 characters long, with 
                   at least one lowercase letter, one uppercase letter, 
                   and one number.';
        }
        /*  end validation    */
        if (empty($reg_errors)) {
            //Validation OK: Create User 
            //New stuff here
            //Reading post inputs
            $email = $_POST['email'];
            $password = $_POST['password2'];
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            //call dbHandler createUser method to add user to db
            $data = $dbh->createUser($email, $password, $first_name, $last_name);
            //var_dump ($data);
            
            
            //check data array for result
            if ($data['error'] == false) {
                //$message = $data['message'];
                $active = $data['active'];
                //var_dump($active);
                //=================== SEND EMAIL ======================//
                //1.  Prepare to send email
                $siteURL = "http://localhost:8888/GradTracker/activation.php?x=" . urlencode($email) . "&y=$active";
                $replyToEmail = 'fakegradtrackers@gmail.com';
                $replyToName = 'GradTracker';
                $mailSubject = 'GradTracker Registration';
                $messageTEXT = "Thank you for registering at GradTracker.\n\n
                                    To activate your account please click on this link:  "
                        . $siteURL;
                $messageHTML = "<p><strong>Thank you for registering at GradTracker.</strong></p> 
                                    <p>To activate your account, please click on this link:</p>
                                    <a href='$siteURL'>Activate our Account</a>";
                $fromEmail = 'fakegradtrackers@gmail.com';
                $fromName = 'GradTracker';
                $toEmail = $email;
                $toName = $firstname . ' ' . $lastname;
                //2.  Send email
                require './mail/sendmail.php';
                $mail = new sendMail($replyToEmail, $replyToName, $mailSubject, $messageHTML, $messageTEXT, $fromEmail, $fromName, $toEmail, $toName);
                $result = $mail->SendMail();
                if ($result) {
                    // MAIL SUCCESS: show html message
                    echo '<div class="alert alert-success"><strong>Account Registered</strong>
                                <p>A confirmation email has been sent to your email address.  
                                    Please click on the link in that email in order to activate 
                                    your account.
                                </p>
                              </div>';
                } else {
                    //MAIL ERROR
                    echo '<div class="alert alert-success"><strong>Account Registered</strong>
                                <p>Warning:  There was a problem sending a confirmation email to the following email: <strong>' .
                    $email . '</strong>.</p> <p>Please contact customer support!</p>                                 
                              </div>';
                }
                //================== END SEND EMAIL ===================//
            } else {
                echo '<div class="alert alert-danger"><strong>Registration Failed</strong>
                        <p>The following error has occured: ' . $data['message'] . '</p>' . 
                        '<a class="btn btn-primary" href="register.php">Try again</a></p></div>';
            }
            //finish page:  hide form
            echo '</div>';
            exit();
            //end new stuff
        } else {
            //Validation Errors: Display Errors
            //var_dump($reg_errors);
            echo '<div class="alert alert-danger">';
            echo '<ul>';
            foreach ($reg_errors as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul>';
            echo '</div> ';
        }
    }
    ?>




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
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="register.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input name="firstname" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name"
                value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input name="lastname" class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name"
                       value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email"
                   value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
          </div>
          <div class="form-group">
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
          </div>
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.html">Login Page</a>
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