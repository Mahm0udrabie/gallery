<?php include("includes/header.php"); ?>
<?php
$check_user = User::find_by_id($_SESSION['user_id']);
if($check_user->status != "Admin") { 
    redirect("../index.php");
} else if ($check_user->status == "Admin") {
if(!$session->is_signed_in()){ redirect("login.php"); }?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->


<?php include("includes/top_nav.php"); ?>



        
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include("includes/side_nav.php"); ?>          
            <!-- /.navbar-collapse -->
        </nav>
        <?php  $photos = Photo::find_all();
        
        ?>

        <div id="page-wrapper">
        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="glyphicon glyphicon-picture"></i>
        <small>Photos </small>
        </h1>
        <p class="text-success bg-success"><?php echo $message; ?></p>
        <div class="col-md-12" >
            <table class="table table-striped table-bordered text-center" >
                <thead >
                    <tr class="text-center">
                    <th class="text-center" style="font-size:25px;"><i class="glyphicon glyphicon-cog"></i></th>
                    <th class="text-center">Photo <i class="glyphicon glyphicon-picture"></i></th>
                    <th class="text-center">File Name</th>
                    <th class="text-center">Details</th>
                 
                    <th class="text-center">Comments</th>

                    </tr>
                </thead>
                <tbody>
                <?php foreach ($photos as $photo) : ?>
                
                <tr>
                <td>

                <div class="pictuers_link " id="hidelinks<?php echo $photo->id; ?>">
                <a title="Delete photo" class="delete_link" href="delete_photo.php?id=<?php echo $photo->id ?>"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                <a title="Edit photo" href="edit_photo.php?id=<?php echo $photo->id ?>"><i class="glyphicon glyphicon-edit text-primary"></i></a>
                <a title="Open photo" href="../photo.php?id=<?php echo $photo->id ?>"><i class="glyphicon glyphicon-eye-open "></i></a>
                </div>
                </td>
                <td>
                <img class="admin-photo-thumbnail" src="<?php echo  $photo->picture_path(); ?>" >
                </td>

                
                <td><?php echo $photo->filename; ?><br>
                <?php echo "title:" .$photo->title; ?></td>
                <td><?php echo "type:" .$photo->type; ?>
                <?php echo "size:" . $photo->size; ?></td>
                <td><?php
                $comments = Comment::find_the_comments($photo->id);
                ?>

                <a title="view Comments" href="photo_comment.php?id=<?php echo $photo->id ?>">
                <?php 
                                echo count($comments); 

                ?></a></td>

                </tr>               
                <?php endforeach; ?>
                </tbody>


            </table>
            <!--  End of table -->
        </div>

      

     
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/footer.php"); } ?>