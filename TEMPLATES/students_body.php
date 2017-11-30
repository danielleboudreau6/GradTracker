  <div class="content-wrapper">
    <div class="container-fluid">
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">
          Students
        </li>
        <!--<li class="breadcrumb-item active">Home</li>-->
       </ol>
        
       
    </div>
  
      
      <!-- Icon Cards-->
      
    <div class="container-fluid">
        <div class="col-lg-12">
            <?php
                // these two lines are required anytime you need to connect to the database
                // 1.  get the configureation file (holds the connection info)
                require './includes/config.php';

                // 2.  connect to the database
                require MYSQL;
        
                $q = "select * from grads";
                $stmt = $dbc->query($q);
                // var_dump($stmt);
                
                $grad_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                //var_dump($grad_list);
                
                echo "<table class='table table-bordered table-striped'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>Name</th>
                            <th>Grad Year</th>
                            <th>LinkedIn</th>
                        </tr>
                    </thead>
                    <tbody>";
        
        echo "</tbody></table>";
        
            ?>
            
            
            
            
            
        </div>
    </div>
  </div>
