  <div class="content-wrapper">
        <div class="container-fluid">
            
            <h2>Students</h2>
        <hr>
            
           <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">
              Students
            </li>
            <!--<li class="breadcrumb-item active">Home</li>-->
           </ol>

        <!-- Icon Cards-->
        <div class="container-fluid">
            <div class="row">
                
                <?php
            
                if( !empty($_SESSION['member_id']) && $_SESSION['type']=='admin'){

                     echo '<div class="col-lg-3 mx-auto mb-3">
                             <a class="btn btn-primary btn-block" href="addStudent.php">Add a Student</a>
                         </div> ';
                }
                ?>
            </div>
                
<!--                <div class="col-lg-3 mx-auto mb-3">
                    <a class="btn btn-primary btn-block" href="addStudent.php">Add a Student</a>
                </div> -->
               
                <div class="col-lg-12">
                    <?php
                        $data = $dbh->getStudents();
                        if($data['error']==false) {
                            $students = $data['items'];
                            echo "<table id='article-table' class='table table-bordered table-striped'>
                            <thead class='thead-inverse'>
                                <tr>
                                    <th>Name</th>
                                    <th>Grad Year</th>
                                    <th>LinkedIn</th>
                                </tr>
                            </thead>
                            <tbody>";

                            foreach($students as $row) {
                                
                                echo "<tr>
                                        <td>{$row['Name']}</td>
                                        <td>{$row['Grad Year']}</td>
                                        <td><a href='https://www.{$row['LinkedIn']}' target='_blank'><i class='fa fa-linkedin-square fa-2x' aria-hidden='true'></i></a></td>
                                      </tr>";
                            }
                            echo "</tbody></table>";
                        }
                    ?>
                </div>   
            </div>
      </div>
  </div>