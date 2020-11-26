<?php include("includes/header.php"); 
echo date('d-m-y');
?>

<?php 
if(!$session->is_signed_in()){
    redirect('index.php');
}
else {
if(empty($_GET['id'])) {
    redirect('index.php');
}

$photo = Photo::find_by_id($_GET['id']);
if(isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body   = trim($_POST['body']);
    $email   = trim($_POST['email']);
    $date   = date('d-m-y');
    $new_comment = Comment::create_comment($photo->id,$author,$body,$email,$date);
    if($new_comment && $new_comment->save()) {
        redirect("photo.php?id={$photo->id}");
    } else {
       echo  $message = "there was some problems saving";
    }
} else  {
    $author = "";
    $body = "";
    $email = "";
    $date = "";
}
$comments = Comment::find_the_comments($photo->id);
?>



<div class="row">
            <div class="col-md-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>
                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption; ?></p>
                <p>
                    <?php echo $photo->description;  ?>
                </p>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <hr>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control" name="author">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- Posted Comments -->

                <!-- Comment -->
                <?php 
                foreach ($comments as  $comment): 
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author;  ?>   <small><?php  echo $comment->date;  ?></small>

                        <br> <h6><?php echo $comment->email;  ?></h6>
                        </h4>

                        <?php echo $comment->body;  ?>
                    </div>
                </div>
                <?php endforeach; ?>

              

            </div>

            <!-- Blog Sidebar Widgets Column -->
             <div class="col-md-4"> 

            
                 <?php include("includes/sidebar.php"); ?>



         </div> 
        <!-- /.row -->
        </div>
        <?php include("includes/footer.php"); } ?>
         