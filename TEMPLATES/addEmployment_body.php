  <div class="content-wrapper">
    <div class="container-fluid">
        
        <h2>Add a Job</h2>
        <hr>
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="employment.php">Jobs</a>
        </li>
        <li class="breadcrumb-item active">
          Add a Job
        </li>
        <!--<li class="breadcrumb-item active">Home</li>-->
       </ol>
        
    <?php
        if ($_POST) {
            // get post parameters
            $grad_id = $_POST['grad_id'];
            $company_id = $_POST['company_id'];
            $title_id = $_POST['title_id'];
            $start_date = $_POST['start_date'];
            
            $data = $dbh->addEmployment($grad_id, $company_id, $title_id, $start_date);
            if($data['error']==false) {
                echo '<div class="alert alert-success"><strong>Insert Success</strong>
                      <p>The job was successfully added.</p></div>';
            }
            else {
                echo '<div class="alert alert-danger"><strong>Insert Failure</strong>
                      <p>An error has occurred, please try again.</p></div>';
            }
            // finish the page - hide the form
            echo '</div>';
            include './includes/footer_section.php'; // footer
            exit();
        } // end of if post
    
        $data = $dbh->getGrads();
        if($data['error']==false) {
            $grads = $data['items'];
        }
        // var_dump($data);
        
        $data2 = $dbh->getPlaces();
        if($data2['error']==false) {
            $companies = $data2['items'];
        }
        //var_dump($data2);
        
        $data3 = $dbh->getPositions();
        if($data3['error']==false) {
            $titles = $data3['items'];
        }
        //var_dump($data3);

        ?>
        <div class="col-lg-6">
            <form method="post" action="addEmployment.php" class="mb-4" novalidate>
        <div class="form-group">
             <label for="grad_id">Student</label>
             <!-- select goes here -->
             <select class="form-control" id="grad_id" name="grad_id">
                 <?php
                    foreach($grads as $grad) {
                        echo "<option value='{$grad['grad_id']}'>{$grad['Name']}</option>";
                    }
                 ?>
             </select>
        </div> 
        <div class="form-group">
             <label for="company_id">Company</label>
             <!-- select goes here -->
             <select class="form-control" id="company_id" name="company_id">
                 <?php
                    foreach($companies as $company) {
                        echo "<option value='{$company['company_id']}'>{$company['company_name']}</option>";
                    }
                 ?>
             </select>
        </div>
        <div class="form-group">
             <label for="title_id">Titles</label>
             <!-- select goes here -->
             <select class="form-control" id="title_id" name="title_id">
                 <?php
                    foreach($titles as $title) {
                        echo "<option value='{$title['title_id']}'>{$title['title_name']}</option>";
                    }
                 ?>
             </select>
        </div>    
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="title">Start Date (YYYY-MM-01)</label>
                    <input class="form-control" id="start_date" name="start_date"
                           type="text"  
                           oninvalid="this.setCustomValidity('Please enter title')" 
                           oninput="setCustomValidity('')"
                           placeholder="Enter start date" required
                           value="<?php if (isset($_POST['start_date'])) echo $_POST['start_date']; ?>">
                </div>
<!--                <div class="col-md-6">
                    <label for="description">Description</label>
                    <input class="form-control" id="description" name="description"
                           type="text"  
                           oninvalid="this.setCustomValidity('Please enter description')" 
                           oninput="setCustomValidity('')"
                           placeholder="Enter description" required
                           value="<?php // if (isset($_POST['description'])) echo $_POST['description']; ?>">
                </div>-->
            </div>
        </div>
<!--        <div class="form-group">
            <label>Article Content</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>-->

        <button type="submit" class="btn btn-primary btn-block">Add Job</button>
        <br>
    </form> 
        </div>
        

    </div>