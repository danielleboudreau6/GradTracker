  <div class="content-wrapper">
    <div class="container-fluid">
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="titles.php">Titles</a>
        </li>
        <li class="breadcrumb-item active">
          Add Title
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
            
           
            $title_name = $_POST['title_name'];

            $data = $dbh->addTitle ($title_name);

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
            <form name="addTitleForm" id="addTitleForm" novalidate method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="title_name">Title:</label>
                        <input type="text" class="form-control" 
                               name="title_name" id="title_name" 
                               placeholder="Enter the title"
                               required data-validation-required-message="Enter the title.">
                        <p class="form-text"></p>
                    </div>
                </div>
                
                <div id="success"></div>
                <!-- For success/fail messages -->
                <button type="submit" class="btn btn-primary" id="addStudentButton">Add Title</button>
                
            </form>

        

    </div>