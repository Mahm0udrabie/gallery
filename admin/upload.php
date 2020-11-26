<?php include("includes/header.php"); ?>
<?php
$check_user = User::find_by_id($_SESSION['user_id']);
if($check_user->status != "Admin") { 
    redirect("../index.php");
} else if ($check_user->status == "Admin") {
if(!$session->is_signed_in()){ redirect("login.php"); } ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->


<?php include("includes/top_nav.php"); ?>



        
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include("includes/side_nav.php"); ?>          
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
        <i class="glyphicon glyphicon-cloud-upload text-primary"></i> 
        <small>Upload </small>
        </h1>

        <?php 
         
         $message = "";
         if(isset($_FILES['file'])){
            $photo = new Photo();
            $photo->title    = $_POST['title'];
            $photo->set_file($_FILES['file']);
            if($photo->save()){
            $message = "<p class='text-success  bg-success'>Photo uploded Succesfully</p><br>";
            } else {
                $message = join("<br>",$photo->errors);
            }
        }
        
           
                ?>
                <div class="row">
        <div class="col-md-6">
        <?php  
        echo "<p class='text-danger  bg-danger'>".$message."</p><br>";
        ?>
        <form  action="upload.php"  enctype="multipart/form-data" method="post">
       
        <div class="form-group">
        <input type="text"  class="form-control css-input" name="title" placeholder="Add title" required>
        </div>
        
        <div class="form-group">
        <input type="file" name="file" placeholder="filename">
        </div>
   
        <div class="form-group">
        <button type="submit" name="submit" class="btn css-btn text-primary">
        <i class="glyphicon glyphicon-cloud-upload "></i> Upload
        </button>   
        </div>    
        </form>     
        </div>
        </div>  <!-- end of row  -->
        <div class="row"> 
        <div class="col-lg-12">
        <form action="upload.php" class="dropzone"></form>
        </div> 
        </div>
      
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/footer.php"); } ?>