<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Report">
          <a class="nav-link" href="students.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Report</span>
          </a>
        </li>
        
        
        
        <?php
        
        //var_dump($_SESSION);
            
            if( !empty($_SESSION['member_id']) && $_SESSION['type']=='admin'){
                
                echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
                        <a class="nav-link" href="admin_profile.php">
                          <i class="fa fa-fw fa-lock"></i>
                          <span class="nav-link-text">Admin</span>
                        </a>
                    </li>';
                
            }elseif( !empty($_SESSION['member_id']) ){
                
                echo '';
                
            }else{ 
               echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Register">
                        <a class="nav-link" href="register.php">
                          <i class="fa fa-fw fa-user-plus"></i>
                          <span class="nav-link-text">Register</span>
                        </a>
                    </li>';   
            }
            
        ?>
        

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Contact">
                    <a class="nav-link" href="ContactUs.php">
                      <i class="fa fa-fw fa-paper-plane-o"></i>
                      <span class="nav-link-text">Contact</span>
                    </a>
                  </li>
                </ul>';

        
       
