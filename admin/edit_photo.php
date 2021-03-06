<?php include("includes/header.php"); ?>
<?php
$check_user = User::find_by_id($_SESSION['user_id']);
if($check_user->status != "Admin") { 
    redirect("../index.php");
}
?>
<?php if(!$session->is_signed_in()){ redirect("login.php"); } 
if(empty($_GET['id'])){
    redirect("photos.php");
} else { 
    $photo = Photo::find_by_id($_GET['id']); 

    if(isset($_POST['update'])){
        if($photo) {
            $photo->title          =  $_POST['title'];
            $photo->caption        =  $_POST['caption'];
            $photo->alternate_text =  $_POST['alternate_text'];
            $photo->description    =  $_POST['description'];
            $photo->update();
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
        <h1 class="page-header">
           <i class="glyphicon glyphicon-wrench"></i>
            <small>Edit Photo</small>
        </h1>
    <div class="col-lg-8">
    <form action="" method="post">

      <div class="form-group">
      <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
      </div>
      <div class="form-group">
      <a class="thumbnail" href=""><img src="<?php echo  $photo->picture_path();?>" alt=""></a>
      </div>
      <div class="form-group">
      <label class="caption">caption</label>
      <input type="text" name="caption" class="form-control" value="<?php echo $photo->caption; ?>">
      </div>
      <div class="form-group">
      <label class="caption">Alternat Text</label>
      <input type="text" name="alternate_text" class="form-control" value="<?php echo $photo->alternate_text; ?>">
      </div>
      <div class="form-group">
      <label class="caption">Description</label>
      <textarea name="description" class="form-control" id="textarea" cols="30" rows="10"><?php echo $photo->description; ?></textarea>
      </div>
    </div>

    <div class="col-md-4" >
        <div  class="photo-info-box">
            <div class="info-box-header">
                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
            </div>
        <div class="inside">
            <div class="box-inner">
                <p class="text">
                <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                </p>
                <p class="text ">
                Photo Id: <span class="data photo_id_box">34</span>
                </p>
                <p class="text">
                Filename: <span class="data">image.jpg</span>
                </p>
                <p class="text">
                File Type: <span class="data">JPG</span>
                </p>
                <p class="text">
                File Size: <span class="data">3245345</span>
                </p>
            </div>
            <div class="info-box-footer clearfix">
            <div class="info-box-delete pull-left">
                <a  class="delete_link" href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
            </div>
            <div class="info-box-update pull-right ">
                <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
            </div>   
            </div>
        </div>          
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

<?php include("includes/footer.php"); ?>