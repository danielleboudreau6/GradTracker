  <div class="content-wrapper">
    <div class="container-fluid">
        
        <h2>Add a Company</h2>
        <hr>
        
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="companies.php">Companies</a>
        </li>
        <li class="breadcrumb-item active">
          Add Company
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
            
            $company_name = $_POST['company_name'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $province_state = $_POST['province_state'];
            $postal = $_POST['postal'];
            $country_id = $_POST['country_id'];
            $website = $_POST['website'];
            $contact_fname = $_POST['contact_fname'];
            $contact_lname = $_POST['contact_lname'];
            $contact_phone = $_POST['contact_phone'];
            $contact_email = $_POST['contact_email'];
            
            $data = $dbh->addCompany($company_name,$address,$city,$province_state,$postal,$country_id,
                                     $website,$contact_fname,$contact_lname,$contact_phone,$contact_email);

            var_dump($data);
            
            
            if($data['error']==false) {
                // it worked
                // put in a success box of some kind
                echo '<div class="alert alert-success"><strong>Company Added</strong>
                                <p>You have successfully added a new company. 
                                </p>
                                <a href="addcompany.php">Add Another Company</a>
                              </div>';
                 
            }
            else {
                // didn't work
                // alert box of some kind
                echo '<div class="alert alert-danger"><strong>Add a Company Failed</strong>
                                <p>An error has occurred.
                                </p>
                                <a href="addcompany.php">Try Again</a>
                              </div>';
            }
            
        }

        ?>
        
        
        
                 
            <form name="addCompanyForm" id="addCompanyForm" novalidate method="post">
                
                
                
                <div class="control-group form-group">
                    <div class="controls">
                            
                        <label for="company_name">Company Name:</label>
                        <input type="text" class="form-control" 
                               name="company_name" id="company_name" 
                               placeholder="Enter the company name"
                               required data-validation-required-message="Enter the company name.">
                        <p class="form-text"></p>
                    </div></div>
                    
                      
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" 
                               id="address" name="address" 
                               placeholder="Enter the address">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" 
                               id="city" name="city"
                               placeholder="Enter the city">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="province_state">Province-State:</label>
                        <input type="text" class="form-control" 
                               id="province_state" name="province_state"
                               placeholder="Enter the province (or city)">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="postal">Postal:</label>
                        <input type="text" class="form-control" 
                               id="postal" name="postal"
                               placeholder="Enter the postal code (or zip code)">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="country_id">Country:</label>
                        <select name="country_id" id="country_id" class="form-control">
                            <option value="1" selected>Canada</option>
                            <option value="2">United States</option>
                            <option value="3">Mexico</option>
                            <option value="4">Italy</option>
                            <option value="5">France</option>
                            <option value="6">Germany</option>
                            <option value="7">United Kingdom</option>
                            <option value="8">Switzerland</option>
                            <option value="9">India</option>
                        </select>
                    </div>
                </div>
                
                    
        
            <div class="control-group form-group">
                <div class="controls">
                    <label for="website">Website:</label>
                    <input type="text" class="form-control" 
                           id="website" name="website"
                           placeholder="Enter the website">
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label for="contact_fname">Contact First Name:</label>
                    <input type="text" class="form-control" 
                           id="contact_fname" name="contact_fname"
                           placeholder="Enter the contact's first name">
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label for="contact_lname">Contact Last Name:</label>
                    <input type="text" class="form-control" 
                           id="contact_lname" name="contact_lname"
                           placeholder="Enter the contact's last name">
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label for="contact_phone">Contact Phone:</label>
                    <input type="tel" class="form-control" 
                           id="contact_phone" name="contact_phone"
                           placeholder="Enter the contact's phone">
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label for="contact_email">Contact Email:</label>
                    <input type="email" class="form-control" 
                           id="contact_email" name="contact_email"
                           placeholder="Enter the contact's email">
                </div>
            </div>
        
                    <div class="col-lg-12">
                        
                  <div id="success"></div>      
                <button type="submit" class="btn btn-block btn-primary" id="addCompanyButton">Add Company</button>
                
                <br>
                </div>
</form>
            

        </div>
        

    </div>
