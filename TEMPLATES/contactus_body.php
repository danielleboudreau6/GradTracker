<div class="content-wrapper">
    <div class="container-fluid">
        <div class="form-group">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Contact us</li>
            </ol>

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

                    if (preg_match('/^[A-Z ()!?;\'.-]{2,5000}$/i', $_POST['Message'])) {
                        $Message = trim($_POST['Message']);
                    } else {
                        $reg_errors['Message'] = 'Please enter your Message!';
                    }

                    if (empty($reg_errors)) {
                        //var_dump($_POST);
                        echo "<p>Thank you! for your submission</p>";
                        echo "<p>Go <a href='index.php'>back</a> to Homepage?</p>";
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
                        <input type="text" class="form-control" id="name" placeholder="Example:Samuel">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput2">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Example:exam@ple.com">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput2">Message</label>
                        <input type="text" class="form-control" id="message" placeholder="type youre message here">
                    </div>
                    <hr>
                    <td><input name="submit" type="submit" id="submit" value="Send" /></td>
                        <!--cant figure out how to fix submit error's -->
                </form>
        </div>
    </div>
</div>