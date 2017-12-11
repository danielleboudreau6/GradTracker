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
        // 1.  check if the form was submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);

            //die;

            $category = trim(filter_var($_POST['company_name'], FILTER_SANITIZE_STRING));

            // test if the user entered something
            if(!empty($category)) {
                // 1.  get the configuration file (holds the connection info)
                require './includes/config.php';

                // 2.  connect to the database
                require MYSQL;

                // build the insert statement using prepared statements
                $stmt = $dbc->prepare("INSERT INTO companies(company_name) VALUES (:company_name)");

                // bind the named parameter :category to user input value
                $stmt->bindValue(':company_name', $category, PDO::PARAM_STR);

                try {
                    // try to execute the query
                    $stmt->execute();
                    echo "<div class='alert alert-success' role='alert'>
                        The company <strong>$company_name</strong> has been inserted.
                    </div>";
                } catch (Exception $ex) {
                    $code = $ex->getCode();
                    $message = 'Unknown system error';

                    if($code == 23000) {
                        $message = 'You may not insert a duplicate company';
                    }
                    // if an error occurs, it will be trapped here
                    echo "<div class='alert alert-danger' role='alert'>
                        The company <strong>$company_name</strong> was not inserted due to a system error.<br>"
                            . $message 
                            . "<p><a href=''>Please try again.</a></p>
                    </div>";
                }
            } 
        
    } else {

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

        <?php
         }
        ?>

    </div>