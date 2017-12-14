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

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Login</div>
        <div class="card-body">
          
          <?php
          var_dump($_POST);
          // && ['active']==NULL
          
            if ($_POST) {
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            //Attempt login 
            $data = $dbh->checkLogin($email, $password);
            var_dump($data);

            if($data){//true: login success or false: login failed
                //login success - get the user by email
                $data = $dbh->getUserByEmail($email);
                //var_dump($data);
                if ($data['error'] == false) {
                    $userItems = $data['items'];
                    //var_dump($userItems); 
                    foreach ($userItems as $item) {
                        $userid = $item['id'];
                        $firstname = $item['first_name'];
                        $lastname = $item['last_name'];
                        $fullname = $firstname . ' ' . $lastname;
                        $admin = $item['admin'];
                    }
                    //store data in session
                    $_SESSION['user_id'] = $userid;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['admin'] = $admin;
                //show success and redirect user to home page (countdown)
                echo '<div class="alert alert-success">                      
                      <p><strong>Welcome, '.$fullname.'</strong></p>
                      <p>You have successfully signed in.  
                      Thank you for browsing GradTracker.</p>
                      <a href="index.php">Back to Home</a>
                      </div>';     
            }
            //finish page:  hide form
            echo '</div>
                  </div>';
            include './includes/footer.php'; //footer
            exit();
            }else{
               //login failed- show message
                echo '<div class="alert alert-danger"><strong>Login Failed</strong>
                        <p>Invalid credentials entered. Please try again.</p>
                      </div>'; 
            }
        }//end of if POST
        ?>
          
        <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input class="form-control" name="" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input class="form-control" name=""id="exampleInputPassword1" type="password" placeholder="Password">
            </div>
            
            <button type="submit" name="" class="btn btn-primary btn-block">Login</button>
          </form>
          <div class="text-center">
              <br>
              <p>Not a member? Please <a href="register.php">Register and Account</a></p>
          </div>
          <div class="text-center">
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