  <div class="content-wrapper">
    <div class="container-fluid">
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="employment.php">Employment</a>
        </li>
        <li class="breadcrumb-item active">
          Add Employment
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
            $company_name = $_POST['company_name'];
            $title_name = $_POST['title_name'];
            $start_date = $_POST['start_date'];
            
            
            $data = $dbh->addEmployment($fname, $lname, $company_name, $title_name, $start_date);

            // var_dump($data);
            
            
            if($data['error']==false) {
                // it worked
                // put in a success box of some kind
                echo $data['message'];
                 
            }
            else {
                // didn't work
                // alert box of some kind
                echo $data['message'];
            }
            
        }

        ?>
        <div class="col-lg-6">
            <form name="addEmploymentForm" id="addEmploymentForm" novalidate method="post">
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
                        <label for="company_name">Company Name:</label>
                        <input type="text" class="form-control" 
                               id="company_name" name="company_name"
                               placeholder="Enter the company name.">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="title_name">Title Name:</label>
                        <input type="text" class="form-control" 
                               id="title_name" name="title_name"
                               placeholder="Enter the title name.">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="start_date">Start Date (YYYY-MM-01):</label>
                        <input type="text" class="form-control" 
                               id="start_date" name="start_date"
                               placeholder="Enter the start date.">
                    </div>
                </div>

                <div id="success"></div>
                <!-- For success/fail messages -->
                <button type="submit" class="btn btn-primary" id="addEmploymentButton">Add Employment</button>
                
            </form>
        </div>
        

    </div>