<?php include("includes/header.php"); ?>
<?php
$check_user = User::find_by_id($_SESSION['user_id']);
if($check_user->status != "Admin") { 
    redirect("../index.php");
} else if ($check_user->status == "Admin") {
if(!$session->is_signed_in()){ redirect("login.php"); }
 if(empty($_GET['id'])) {
    redirect("photos.php");
} 
$comments = Comment::find_the_comments($_GET['id']);
?>
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
        <h1 class="page-header"><i class="glyphicon glyphicon-comment"></i>
        <small>Comments </small>
        </h1>
      
        <p class="text-success bg-success"><?php echo $message; ?></p>

        <div class="col-md-12">
        <table class="table table-striped table-bordered text-center" >
                <thead >
                    <tr>
                    <th class="text-center" style="font-size:25px;"><i class="glyphicon glyphicon-cog"></i></th>
                    <th class="text-center">author</th>
                    <th class="text-center">body</th>

                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($comments as $comment) : ?>
                <tr>
                <td>
                <div class="action_links">
                <a class="delete_link" href="delete_comment_photo.php?id=<?php echo $comment->id ?>">
                <i class="glyphicon glyphicon-trash text-danger"></i></a>
                </div>    
                </td>
                <td><?php echo $comment->author; ?>
                </td>
                <td><?php echo $comment->body; ?></td>

                </tr>               
                <?php endforeach; ?>
                </tbody>


            </table><!--  End of table -->
            <hr>


    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); } ?>