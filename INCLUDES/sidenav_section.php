<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Report">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file-o"></i>
            <span class="nav-link-text">Reports</span>
          </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
                <a href="students.php"><i class="fa fa-fw fa-graduation-cap"></i> Students</a>
            </li>
            <li>
                <a href="companies.php"><i class="fa fa-fw fa-building-o"></i> Companies</a>
            </li>
            <li>
              <a href="titles.php"><i class="fa fa-fw fa-id-card-o"></i> Titles</a>
            </li>
            <li>
                <a href="employment.php"><i class="fa fa-fw fa-briefcase"></i> Jobs</a>
            </li>
          </ul>
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

        
       
