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
                $data = $dbh->getStudents();
                //var_dump($data);
                
                // var_dump($grad_query);
                if($data['error']==false) {
                    $students = $data['items'];
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
                
                    foreach($students as $row) {
                        echo "<tr>
                                <td>{$row['Name']}</td>
                                <td>{$row['Grad Year']}</td>
                                <td>{$row['Company']}</td>
                                <td>{$row['Title']}</td>
                              </tr>";
                    
                    }
                    echo "</tbody></table>";
                
                }
        
        
        
            ?>
            
            
            
            
            
        </div>
    </div>
  </div>
