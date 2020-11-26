<?php 
ob_start();
include("includes/header.php"); ?>
<?php include "includes/photo_library_modal.php";
 ?>
<?php 
if(empty($_GET['id'])){
    redirect("index.php");
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
                $session->message("information updated");
                $user->save();
                redirect("edit_profile.php");


            } else {
            $session->message("information updated");
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();
            redirect("edit_profile.php");
            }
        }
    }
}
?>


<div class="row">
        

<!-- Blog Entries Column -->
<div class="col-md-12">
<div class="col-md-6 user_image_box">
<a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="admin/<?php  echo $user->image_path_and_placeholder();  ?>" alt=""></a>
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
<input type="text" name="first_name" class="form-control" value="<?php  echo  $user->first_name ?>">
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
<button type="submit" name="submit" class="btn btn-primary pull-right" >update</button>
</div>   


</form>
</div>
           
</div>

    


    <!-- Blog Sidebar Widgets Column -->
    
 <!--/.row -->

<?php include("includes/footer.php"); ?>
