  <div class="content-wrapper">
    <div class="container-fluid">
        
        <h2>Jobs</h2>
        <hr>
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">
          Jobs
        </li>
        <!--<li class="breadcrumb-item active">Home</li>-->
       </ol>
        
        
       
    </div>
  
      
      <!-- Icon Cards-->
      
    <div class="container-fluid">
        <div class="row">
            
            
            <?php
            
           if( !empty($_SESSION['member_id']) && $_SESSION['type']=='admin'){
                
                echo '<div class="col-lg-12">
                        <a class="btn btn-primary btn-block" href="addEmployment.php">Add a Job</a>
                        <br>
                    </div> ';
           }
                    
            ?>
            
            
            
<!--        <div class="col-lg-3 mx-auto mb-3">
            <a class="btn btn-primary btn-block" href="addEmployment.php">Add a Job</a>
        </div> -->

        <div class="col-lg-12">
            <?php
            
                $data = $dbh->getEmployment();
                //var_dump($data);
                
                if($data['error']==false) {
                    $companies = $data['items'];
                    echo "<table id='article-table' class='table table-bordered table-striped'>
                    <thead class='thead-inverse'>
                        <tr>
                          <th>Name</th>
                          <th>Company</th>
                          <th>Title</th>
                          <th>Start Date</th>
                        </tr>
                    </thead>
                    <tbody>";
                
                    foreach($companies as $row) {
                        echo "<tr>
                                <td>{$row['Name']}</td>
                                <td>{$row['Company']}</td>
                                <td>{$row['Title']}</td>
                                <td>{$row['Start Date']}</td>
                              </tr>";
                    
                    }
                    echo "</tbody></table>";
                
                }

        
            ?>
            
        </div>    

        </div> 
        
    </div>
      
  </div>
