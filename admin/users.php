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
        <i class="fa fa-users"></i>
            <small>Users</small>
        </h1>

        <a href="add_user.php" title="Add user" class="btn"> 
         <i class="glyphicon glyphicon-plus fa-2x"></i>
        </a>
        <p class="text-success bg-success"><?php echo $message; ?></p>

        <div class="col-md-12">
        <table class="table table-striped table-bordered text-center" >
                <thead >
                    <tr>
                    <th class="text-center" style="font-size:20px;"><i class="glyphicon glyphicon-cog"></i></th>
                    <th class="text-center">Photo</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>

                    </tr>
                </thead>
                <tbody>
                <?php 
                $users = User::find_all();
                foreach ($users as $user) : ?>
                <tr>
                <td>
                <div class="action_links">
                <a class="delete_link" href="delete_user.php?id=<?php echo $user->id ?>"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                <a href="edit_user.php?id=<?php echo $user->id ?>"><i class="glyphicon glyphicon-edit text-primary"></i></a>
                </div>
            
                </td>
                <td><img class="admin-photo-thumbnail user_image" src="<?php echo $user->image_path_and_placeholder(); ?>" > 
                </td>
                <td><?php echo $user->username; ?>
               
                

                

                </td>
                
                <td><?php echo $user->first_name; ?></td>
                <td><?php echo $user->last_name; ?></td>

                </tr>               
                <?php endforeach; ?>
                </tbody>


            </table><!--  End of table -->


    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); } ?>