  <div class="content-wrapper">
    <div class="container-fluid">
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">
          Companies
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
            
            $company_name = $_POST['company_name'];
            $data = $dbh->addCompany($company_name);
            
            
            //var_dump($data);
            
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

        <form class="form-inline" method="post" action="addCompany.php">
            <div class="form-group mx-sm-3">
                <label for="company_name" class="sr-only">Company</label>
                <input type="text" class="form-control" 
                       id="company_name" name="company_name" 
                       placeholder="Enter new company">
            </div>
            <button type="submit" class="btn btn-primary">Add Company</button>
        </form>

        

    </div>