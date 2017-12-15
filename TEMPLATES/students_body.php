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
            <div class="row">
                <div class="col-lg-3 mx-auto mb-3">
                    <a class="btn btn-primary btn-block" href="addStudent.php">Add a Student</a>
                </div> 
                <div class="col-lg-3 mx-auto mb-3">
                    <a class="btn btn-primary btn-block" href="editStudent.php">Edit a Student</a> 
                </div>
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
                                        <td>{$row['LinkedIn']}</td>
                                      </tr>";
                            }
                            echo "</tbody></table>";
                        }
                    ?>
                </div>   
            </div>
        </div>
  </div>
