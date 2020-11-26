    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-award"></i>
        </a>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="border:none !important;background-color:#6f0808 !important;color:white;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav ">
            
           
                    
                    <li>
                        <a href="#Aboutus">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#" >Contact us</a>
                    </li>
                    <?php 
                    if($session->is_signed_in()) { 

                    $check_user = User::find_by_id($_SESSION['user_id']);
                    if($check_user->status == "Admin") {
                    ?>
                    <li>
                        <a href="admin/">Admin</a>
                    </li>
                    <?php } ?>
                </ul>   
                <?php 
                 $list_format = User::find_by_id($_SESSION['user_id']); 
                if(isset($_POST['list_4'])) {
                   
                    if($list_format) {
                    $list_format->list_type = "list_4";
                    $list_format->update();
                    } 
                }
                if(isset($_POST['list_1'])) {
                   
                    if($list_format) {
                    $list_format->list_type = "list_1";
                    $list_format->update();
                    } 
                }
                
                ?>
               
                <ul class="nav navbar-nav navbar-right top-nav">   
                  
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  
                    <?php 
                    $current_username = User::find_by_id($_SESSION['user_id']);
                    echo $current_username->username;
                    
                    ?>
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu dropmenu">
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="edit_profile.php?id=<?php echo $_SESSION['user_id'] ?>"><i class="glyphicon glyphicon-cog"></i> Settings</a>
                        </li>
                        <li>
                            <a href="logout.php"><i class="glyphicon glyphicon-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                  </ul>
                    <?php } ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <?php  if(!$session->is_signed_in()) {  ?>
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header nav-2 " data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <button type="button" class="glyphicon glyphicon-menu-down pull-right navbar-toggle" style="border:none !important;background-color:transparent !important;color:white;">
                </button>
               
            </div>
        <div class="collapse navbar-collapse nav-2" id="bs-example-navbar-collapse-2" >    
        <ul class="nav navbar-nav pull-right" >
                    
                    <li>
                        <a href="#" id="login-form" style="color:white !important;font-size: 13px;">
                        <i class="glyphicon glyphicon-log-in"></i> login
                        </a>
                    </li>
                    <li>
                        <a href="#" id="sign-up-form" style="color:white !important;font-size:13px;">
                        <i class="glyphicon glyphicon-log-out"></i> sign-up
                    </a>
                    </li>
                </ul>
 
                <style>
                    .nav-2 {
                                background-color:#6f0808 !important;              
                            }
                        .nav-ul > li {

                                    color: red !important;
                                    font-size: 15px;
                                    font-family: fantasy;
                            }
                            .navbar-inverse {
                                background-color: white !important;
                                border-color: #6f0808  !important;
                            }
                </style>
                <?php } ?>
                <style>
                .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {
                    color:black !important;
                    background-color:transparent !important;

                } 
                
                </style>
        </div>
   
        <!-- /.container -->
    </nav>
    
