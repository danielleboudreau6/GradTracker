  <div class="content-wrapper">
    <div class="container-fluid">
        
        <h2>Add a Student</h2>
        <hr>
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="students.php">Students</a>
        </li>
        <li class="breadcrumb-item active">
          Add Student
        </li>
        <!--<li class="breadcrumb-item active">Home</li>-->
       </ol>
        
        
        
    <?php
    
        if(isset($_SESSION['member_id'])){
            //we found a user who is logged in - store their id in variable
            $member_id = $_SESSION['member_id'];
            
        }else{
            $member_id = null;
        }
        //var_dump($member_id);//null when not logged in
        if($_POST) {
            
           
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $linkedin = $_POST['linkedin'];
            $student_id = $_POST['student_id'];
            $program_id = $_POST['program_id'];
            $gradyear = $_POST['gradyear'];
            
            
            $data = $dbh->addStudent($fname, $lname, $email, $linkedin, $student_id,
                                     $program_id, $gradyear);

            var_dump($data);
            
            
            if($data['error']==false) {
                // it worked
                // put in a success box of some kind
                echo '<div class="alert alert-success"><strong>Student Added</strong>
                                <p>You have successfully added a new student. 
                                </p>
                                <a href="addstudent.php">Add Another Student</a>
                              </div>';
                 
            }
            else {
                // didn't work
                // alert box of some kind
                echo '<div class="alert alert-danger"><strong>Add a Student Failed</strong>
                                <p>An error has occurred.
                                </p>
                                <a href="addstudent.php">Try Again</a>
                              </div>';
            }
            
        }

        ?>
        <div class="col-lg-6">
            <form name="addStudentForm" id="addStudentForm" novalidate method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" 
                               name="fname" id="fname" 
                               placeholder="Enter the first name"
                               required data-validation-required-message="Enter the first name.">
                        <p class="form-text"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" 
                               name="lname" id="lname" 
                               placeholder="Enter the last name"
                               required data-validation-required-message="Enter the last name.">
                        <p class="form-text"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" 
                               id="email" name="email"
                               placeholder="Enter the email">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="linkedin">LinkedIn:</label>
                        <input type="text" class="form-control" 
                               id="linkedin" name="linkedin"
                               placeholder="Enter the LinkedIn profile">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="student_id">Student ID:</label>
                        <input type="text" class="form-control" 
                               id="student_id" name="student_id" 
                               placeholder="Enter the student ID">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="program_id">Program:</label>
                        <select name="program_id" id="program_id" class="form-control">
                            <option value="1" selected>Web and Mobile Development</option>
                            <option value="2">System Management and Cyber Security</option>
                        </select>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="gradyear">Grad Year:</label>
                        <input type="text" class="form-control" 
                               id="gradyear" name="gradyear"
                               placeholder="Enter the grad year">
                    </div>
                </div>

                <div id="success"></div>
                <!-- For success/fail messages -->
                <button type="submit" class="btn btn-primary btn-block" id="addStudentButton">Add Student</button>
                <br>
                
            </form>
        </div>
        

    </div>