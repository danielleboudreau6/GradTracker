<div class="content-wrapper">
    <div class="container-fluid">
        <div class="form-group">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Contact Us</li>
            </ol>
            
        <h2>Contact Us</h2>
        <hr>

            <head>
                <meta charset="UTF-8">
                <title>form 2</title>
                <style>
                    .error{font-weight:bold;color:red;}
                </style>
            </head>
            <body>
                
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $reg_errors = array();

                    if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['name'])) {
                        $name = trim($_POST['name']);
                    } else {
                        $reg_errors['name'] = 'Please enter your name!';
                    }

                    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $email = $_POST['email'];
                    } else {
                        $reg_errors['email'] = 'please enter a valid email!';
                    }

                    if (preg_match('/^[A-Z ()!?;\'.-]{2,5000}$/i', $_POST['message'])) {
                        $Message = trim($_POST['message']);
                    } else {
                        $reg_errors['message'] = 'Please enter your Message!';
                    }

                    if (empty($reg_errors)) {
                        //var_dump($_POST);
                        echo "<p>Thank you for your submission!</p>";
                        include './mail/sendmail.php';
                        $mail = new sendMail($email, $name, 'Inquiry from GradTracker', $Message, $Message, 'fakegradtrackers@gmail.com', 'GradTracker', 'danielle_boudreau_6@hotmail.com', 'Danielle Boudreau');
    
                            $result = $mail->SendMail();

                if ($result){
                    echo "Your email was successfully sent.";
                }else{
                    echo "Your email failed to send.";
                }
                echo "<p><a href='index.php'>Back to Home</a></p>";        
                include './includes/footer_section.php';
                exit();
                
                    } else {
                        //var_dump($reg_errors);
                        echo"<ul>";
                        foreach ($reg_errors as $error) {
                            echo "<li class='error'>$error</li>";
                        }
                    }
                } else {
                    
                }
                ?>
                <form id="contact" name="contact" method="post" action="contactus.php">

                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Type Name Here">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput2">Email</label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="Type Email Here">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput2">Message</label>
<!--                        <input name="message" type="text" class="form-control" id="message" rows="4" placeholder="Type Your Message Here">-->
                         <textarea name="message" class="form-control" id="message" cols="40" rows="4"placeholder="Type Your Message Here"></textarea>
                    </div>
                    <hr>
                    <td><input name="submit" type="submit" id="submit" value="Send" class="btn btn-primary btn-block" /></td>
                        <!--cant figure out how to fix submit error's -->
                </form>
        </div>
    </div>
</div>