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
        
                $sql = "select count(*) from grads";
                $stmt = $dbc->query($sql);
                $cnt = $stmt->fetchColumn();
                
                // echo "<h2>Total Grads: $cnt</h2>";
                
                // $q = "SELECT fname, lname, gradyear, linkedin FROM grads;";
                $q = "select concat(fname, ' ', lname) as Name, gradyear as 'Grad Year', company_name as 'Company', title_name as Title
                      from grads join employment on grads.grad_id = employment.grad_id
                      join companies on employment.company_id = companies.company_id
                      join titles on employment.title_id = titles.title_id
                      order by gradyear desc, name;";
                
                $stmt = $dbc->query($q);
                
                $grad_query = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // var_dump($grad_query);

                echo "<table class='table table-bordered table-striped'>
                    <thead class='thead-inverse'>
                        <tr>
                            <th>Name</th>
                            <th>Grad Year</th>
                            <th>Company</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>";
                
                foreach($grad_query as $row) {
                    echo "<tr>
                            <td>{$row['Name']}</td>
                            <td>{$row['Grad Year']}</td>
                            <td>{$row['Company']}</td>
                            <td>{$row['Title']}</td>
                          </tr>";
                }
        
        echo "</tbody></table>";
        
            ?>
            
            
            
            
            
        </div>
    </div>
  </div>
