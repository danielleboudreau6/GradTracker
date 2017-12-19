  <div class="content-wrapper">
    <div class="container-fluid">
        
        <h2>Titles</h2>
        <hr>
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">
          Titles
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
                        <a class="btn btn-primary btn-block" href="addTitle.php">Add a Title</a>
                        <br>
                    </div> ';
           }
            ?>
            
<!--        <div class="col-lg-3 mx-auto mb-3">
            <a class="btn btn-primary btn-block" href="addTitle.php">Add a Title</a>
        </div> -->
            
        <div class="col-lg-12">
            <?php
            
                $data = $dbh->getTitles();
                //var_dump($data);
                
                if($data['error']==false) {
                    $companies = $data['items'];
                    echo "<table id= 'article-table' class='table table-bordered table-striped'>
                    <thead class='thead-inverse'>
                        <tr>
                          <th>Titles</th>
                        </tr>
                    </thead>
                    <tbody>";
                
                    foreach($companies as $row) {
                        echo "<tr>
                                <td>{$row['Titles']}</td>
                              </tr>";
                    
                    }
                    echo "</tbody></table>";
                
                }
        
            ?>
            
        </div>
        </div> 
    </div>
  </div>
