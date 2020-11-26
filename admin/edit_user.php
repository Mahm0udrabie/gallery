<?php 
ob_start();
include("includes/header.php"); 
include "includes/photo_library_modal.php";

?>
<?php
$check_user = User::find_by_id($_SESSION['user_id']);
if($check_user->status != "Admin") { 
    redirect("../index.php");
} else if ($check_user->status == "Admin") {
if(!$session->is_signed_in()){ redirect("login.php"); }

if(empty($_GET['id'])){
    redirect("users.php");
} else { 
    $user = User::find_by_id($_GET['id']);
    if(isset($_POST['submit'])){
        if($user) {
            $user->username   =  $_POST['username'];
            $user->first_name =  $_POST['first_name'];
            $user->last_name  =  $_POST['last_name'];
            $user->password   =  $_POST['password'];
            if(empty($_POST['password'])) {
                $current_User = User::find_by_id($_GET['id']);
                $user->password = $current_User->password;
            }
            if(empty($_FILES['user_image'])) { 
                $session->message("The user has been updated");
                $user->save();
                redirect("users.php");


            } else {
            $session->message("The user Has been updated");
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();
            // redirect("edit_user.php?id={$user->id}");
            redirect("users.php");
           


            }
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

<div class="col-md-12">

        <h1 class="page-header">
            <i class="glyphicon glyphicon-wrench"></i>
           <small>Edit user</small>
        </h1>
        
        <div class="col-md-6 user_image_box">

      <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo $user->image_path_and_placeholder();  ?>" alt=""></a>
        
    </div>
    
        <div class="col-md-6">

    <form action="" method="post" enctype="multipart/form-data">

      <div class="form-group">
      <input type="file" name="user_image"  >
      </div>

      <div class="form-group">
      <label class="caption">username</label>
      <input type="text" name="username" class="form-control" value="<?php echo  $user->username ?>">
      </div>

      <!-- <div class="form-group">
      <a class="thumbnail" href="">
      </div> -->

      <div class="form-group">
      <label class="caption">firstname</label>
      <input type="text" name="first_name" class="form-control" value="<?php echo  $user->first_name ?>">
      </div>

      <div class="form-group">
      <label >last name</label>
      <input type="text" name="last_name" class="form-control" value="<?php echo  $user->last_name ?>">
      </div>

      <div class="form-group">
      <label >password</label>
      <input type="password"  name="password" class="form-control" value="<?php  $user->password ?>">
      </div>
      <div class="form-group">
      <a id="user-id"  href="delete_user.php?id=<?php echo $user->id;?>" class="btn btn-danger ">Delete</a>
      <button type="submit" name="submit" class="btn btn-primary pull-right" >update</button>
      </div>   
      

    </form>
    
   </div>


      

     
        </div>
    </div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/footer.php");  }?>