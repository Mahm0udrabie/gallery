<?php include("includes/header.php"); ?>
<?php
$check_user = User::find_by_id($_SESSION['user_id']);
if($check_user->status != "Admin") { 
    redirect("../index.php");
} else if ($check_user->status == "Admin") {
if(!$session->is_signed_in()){ redirect("login.php"); } 


    if(isset($_POST['submit'])){
        $user = new User(); 
        $user->username   =  $_POST['username'];
        $user->email      =  $_POST['email'];
        $user->first_name =  $_POST['first_name'];
        $user->last_name  =  $_POST['last_name'];
        $user->password   =  $_POST['password'];
        $user->status      =  "Admin";
        if(empty($user->set_file($_FILES['user_image']))) {
            $user->save();
    $session->message("User Added Succesfully");
    redirect("users.php");
        } else {
        $user->set_file($_FILES['user_image']);
        if($user->upload_photo()){
            $session->message("User Added Succesfully");
            redirect("users.php");
            } else {
                $message = join("<br>",$user->errors);
            }
        }
}


?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->


<?php include("includes/top_nav.php"); ?>



        
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include("includes/side_nav.php"); ?>          
            <!-- /.navbar-collapse -->
        </nav>
        <?php  
        // $photos = Photo::find_all(); 
        ?>

        <div id="page-wrapper">
        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
        <?php if(isset($message)) {echo "<p class='text-danger  bg-danger'>".$message."</p><br>"; }?>
        <h1 class="page-header">
        <i class="fa fa-users"></i>

        <small>Add User</small>
        </h1>
    <div class="col-md-6 col-md-offset-3">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
      <input type="file" name="user_image"  >
      </div>

      <div class="form-group">
      <label class="caption">username</label>
      <input type="text" name="username" class="form-control" >
      </div>
      <div class="form-group">
      <label class="caption">Email</label>
      <input type="email" name="email" class="form-control" >
      </div>
      <div class="form-group">
      <label class="caption">firstname</label>
      <input type="text" name="first_name" class="form-control" >
      </div>
      <div class="form-group">
      <label >last name</label>
      <input type="text" name="last_name" class="form-control">
      </div>
      <div class="form-group">
      <label >password</label>
      <input type="password"  name="password" class="form-control">
      </div>
      <div class="form-group">
      <button type="submit" name="submit" class="btn btn-primary pull-right" >submit</button>
      </div>
    </div>
</form>


      

     
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/footer.php"); } ?>