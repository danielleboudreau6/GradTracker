  <div class="content-wrapper">
    <div class="container-fluid">
        
        <h2>Companies</h2>
        <hr>
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">
          Companies
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
                        <a class="btn btn-primary btn-block" href="addCompany.php">Add a Company</a>
                        <br>
                    </div> ';
           }
                    
            ?>
            
<!--        <div class="col-lg-3 mx-auto mb-3">
            <a class="btn btn-primary btn-block" href="addCompany.php">Add a Company</a>
        </div> -->
            
        <div class="col-lg-12">
            <?php
            
                $data = $dbh->getCompanies();
                //var_dump($data);
                
                if($data['error']==false) {
                    $companies = $data['items'];
                    echo "<table id= 'article-table' class='table table-bordered table-striped'>
                    <thead class='thead-inverse'>
                        <tr>
                          <th>Company</th>
                          <th>City</th>
                          <th>Website</th>
                        </tr>
                    </thead>
                    <tbody>";
                
                    foreach($companies as $row) {
                        echo "<tr>
                                <td>{$row['Company']}</td>
                                <td>{$row['City']}</td>
                                <td>{$row['Website']}</td>
                              </tr>";
                    
                    }
                    echo "</tbody></table>";
                
                }
//                // these two lines are required anytime you need to connect to the database
//                // 1.  get the configureation file (holds the connection info)
//                require './includes/config.php';
//
//                // 2.  connect to the database
//                require MYSQL;
//        
//                $sql = "select count(*) from grads";
//                $stmt = $dbc->query($sql);
//                $cnt = $stmt->fetchColumn();
//                
//                
//                // $q = "SELECT fname, lname, gradyear, linkedin FROM grads;";
//                $q = "SELECT company_name as Company, city as City, website as Website from companies order by 1;";
//                
//                $stmt = $dbc->query($q);
//                
//                $grad_query = $stmt->fetchAll(PDO::FETCH_ASSOC);
//                
//                // var_dump($grad_query);
//
//                echo "<table class='table table-bordered table-striped'>
//                    <thead class='thead-inverse'>
//                        <tr>
//                            <th>Company</th>
//                            <th>City</th>
//                            <th>Website</th>
//                        </tr>
//                    </thead>
//                    <tbody>";
//                
//                foreach($grad_query as $row) {
//                    echo "<tr>
//                            <td>{$row['Company']}</td>
//                            <td>{$row['City']}</td>
//                            <td>{$row['Website']}</td>
//                          </tr>";
//                }
//        
//        echo "</tbody></table>";
        
            ?>
            
        </div>    
            
            
           
        </div> 
    </div>
  </div>
