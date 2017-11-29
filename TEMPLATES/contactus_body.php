<div class="content-wrapper">
    <div class="container-fluid">
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="ContactUs.php.php">Contact</a>
        </li>
        <!--<li class="breadcrumb-item active">Home</li>-->
       </ol>

<html>
    <head>
        <meta charset="UTF-8">
        <title>form 2</title>
        <style>
            .error{font-weight:bold;color:red;}
        </style>
    </head>
    <body>
        <?php
        //1. check for form submision
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //if($_POST){...
            //var_dump($_POST);
            
            //create an array variable to hold all possible validation
            
            $reg_errors =array();
            
            //validate the entries 
            //1. validate the name: using a regular expresion
            /*
             * allowed:characters, apos, period, space and dash
             * between 2 and 45 characters in length
             * letters A-Z (case-insensitive
             */
            if(preg_match('/^[A-Z \'.-]{2,45}$/i',$_POST['name'])){
                $name = trim($_POST['name']);
            }else{
                $reg_errors['name']= 'Please enter your name!';
            }
            
            
            //2. validate the email: using a filter
            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $email = $_POST['email'];
            }else{
                $reg_errors['email']='please enter a valid email!';
            }
            
            //3. validate the comments: using a regular
            if(preg_match('/^[A-Z ()!?;\'.-]{2,500}$/i',$_POST['Message'])){
                $Message = trim($_POST['Message']);
            }else{
                $reg_errors['Message']= 'Please enter your Message!';
            }
            
            
            //check for any errors
            if(empty($reg_errors)){
                //var_dump($_POST);
                echo "<p>Thank you! for your submission</p>";
                echo "<p>Go <a href='form1.html'>back</a> to Homepage?</p>";
                exit();
            }else{
                //var_dump($reg_errors);
                echo"<ul>";
                foreach($reg_errors as $error){
                    echo "<li class='error'>$error</li>";
                }
            }
            
            
            
        }else{
            
        }
        
        
        //always show the form
        ?>
        <form id="form1" name="form2" method="post" action="form2.php">
            <table>
              <tr>
                <td colspan="2"><strong>Enter your information in the form below        </strong></td>
              </tr>
              <tr>
                <td><strong>Name:</strong></td>
                <td>
                  <input name="name" type="text" id="name" size="50" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" maxlength="40" />       
                </td>
              </tr>
              <tr>
                <td><strong>Email Address:</strong></td>
                <td>
                    <input name="email" type="text" id="email" size="50" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" maxlength="60" />
                </td>
              </tr>
<!--              <tr>
                <td><strong>Gender</strong>:</td>
                <td>
                    <input type="radio" name="gender" id="genderM" value="M" />
                  Male 
                  <input type="radio" name="gender" id="genderF" value="F" /> 
                  Female
                  <input type="radio" name="gender" id="genderN" value="N" /> 
                  Nonbinary and/or Others
                </td>
              </tr>-->
<!--              <tr>
                <td><strong>Age:</strong></td>
                <td>
                    <select name="age" id="age">
                        <option value="0-29">Under 30</option>
                        <option value="30-60">Between 30 and 60</option>
                        <option value="60+">Over 60</option>
                        <option value="caveMan">cave man</option>
                    </select>       
                </td>        
              </tr>-->
              <tr>
                <td><strong>Messsage:</strong></td>
                <td>
                    <textarea name="Message" id="" cols="70" rows="6"><?php if(isset($_POST['Message'])) echo $_POST['Message']; ?></textarea>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input name="submit" type="submit" id="submit" value="Submit" /></td>
              </tr>
            </table>
        </form>
    </div>
