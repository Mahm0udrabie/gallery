<?php 
                
                $message = "";
                if(isset($_POST['submit'])){
                    $photo = new Photo();
                    
                    $photo->set_file($_FILES['file_upload']);
                    $photo->title    = $_POST['title'];
                    if($photo->save()){
                    $message = "<p class='text-success  bg-success text-center'>Photo uploded Succesfully</p><br>";
                    redirect("index.php");
                } else {
                        $message = "<p class='text-danger  bg-danger  text-center'>{$message}</p><br>";

                        $message .= join("<br>",$photo->errors);
                    }
                }
                
                
                        ?>
                
               

            <!-- Blog Search Well -->
            <?php  if($session->is_signed_in()) { ?>
                <div class="well">
                    <h4>Add photo</h4>
                <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="file"   name="file_upload" required >

                    <div class="input-group">

                        <input type="text"   name="title" class="form-control" placeholder="Add title..." required>

                        <span class="input-group-addon ">
                    <button tybe="submit"  name="submit" style="border:none;width:100%;height:100%;background-color:transparent !important">
                    <i class="glyphicon glyphicon-cloud-upload" style="color:gray !important"></i>
                    </button>
                    </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div>
            
                
    </div><?php } ?>
  
   
    
    

    <?php
 if(!$session->is_signed_in()) { ?> 
 <br><br>
        <div class="well" > 
        <a  class="cancel pull-right text-danger"><i class="glyphicon glyphicon-remove"></i></a>
       
       
        <br>

 <?php 
 
 if(isset($_POST['login'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    //  method to check database user
    $user_found = User::verify_user($username,$password);
    if($user_found) {
        $session->login($user_found);
       redirect("index.php");
       $_SESSION['user_id'];
    } else {
        $the_message = "your password or username are incorrect ";
    } 
} else {
        $username = "";
        $password = ""; 
    }
 ?>
 
 
   <form  class="login text-center" action="" method="post" class="" style="display:none">
   <div class="text-center"  style="width:100px;height:100px;margin:auto;border-radius:50%;">
        <i class="fas fa-user-circle" style="font-size:100px;color:#6f0808;"></i>
    </div>
    <br>
  <div class="input-group">
    <i class="input-group-addon glyphicon glyphicon-user text-danger addon-class"></i>
    
    <input type="text" name="username" id="loginCSS"  placeholder="User Name" required>
  </div>
   <div class="input-group">
 <i class="input-group-addon glyphicon glyphicon-lock text-danger addon-class"></i>
    <input type="password" name="password" id="loginCSS"  placeholder="Password" required>
  </div><br>
  <div class="form-group">
    <button type="submit" name="login" class="login-btn" >login</button>
  </div>
  <a class="btn forget" style="color:#6f0808">forget password</a>
</form> 

<form class="register text-center" action="" method="post" enctype="multipart/form-data" style="display:none">
    <?php
     if(isset($_POST['Register'])){
        $user_Register = new User(); 
        $user_Register->username   =  $_POST['username'];
        $user_Register->email      =  $_POST['email'];
        $user_Register->first_name =  $_POST['firstname'];
        $user_Register->last_name  =  $_POST['lastname'];
        $user_Register->password   =  $_POST['password'];
        $user_Register->status   =  "User";
        if(empty($user_Register->set_file($_FILES['user_image']))) {
            $user_Register->save();
    $session->message("Registration Completed Succesfully");
    redirect("index.php");
        } else {
        $user_Register->set_file($_FILES['user_image']);
        if($user_Register->upload_photo()){
            $session->message("Registration Completed Succesfully");
            redirect("index.php");
            } else {
                $message = join("<br>",$user_Register->errors);
            }
        }
}
    
    ?>
<div class="form-group">
<div class="text-center"  style="width:100px;height:100px;margin:auto;border-radius:50%;">
        <i class="fas fa-user" style="font-size:80px;color:#6f0808;"></i>
        </div>
        <br>
    <input type="text" name="firstname" id="loginCSS" placeholder="First name" required>
  </div>
  <div class="form-group">
    <input   name="lastname" id="loginCSS" placeholder="Last name" required>
  </div>
  <div class="form-group">
    <input type="text" id="loginCSS" name="username"  placeholder="username" required>
  </div>
  <div class="form-group">
    <input type="email"  name="email" id="loginCSS" placeholder="Email" required>
  </div>
 
  <div class="form-group">
    <input type="password"  id="loginCSS" name="password"  placeholder="password" required>
  </div>
  <div class="form-group">
    <button  name="Register"  class="login-btn">Register</button>
  </div>
</form> 



<form class="reset text-center" style="display:none">
  <div class="form-group">
    <input type="email" id="loginCSS" placeholder="Enter Email to reset  account" required>
  </div>
 
  <div class="form-group">
    <button class="login-btn" >submit</button>
  </div>
</form> 
 </div>
    <?php } ?>

                <!-- Side Widget Well -->
                <?php if($session->is_signed_in()){ ?>
                <div class="well ">

                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
                <?php } ?>
            </div>