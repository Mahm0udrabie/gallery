<?php include("includes/init.php");?>
<?php
$check_user = User::find_by_id($_SESSION['user_id']);
if($check_user->status != "Admin") { 
    redirect("../index.php");
} else if ($check_user->status == "Admin") {
if(!$session->is_signed_in()){ redirect("login.php"); } ?>

<?php 
if(empty($_GET['id'])){
    redirect("photos.php");
}
$photo = Photo::find_by_id($_GET['id']);
if($photo){
    $session->message("The {$photo->filename} has been deleted");

    $photo->delete_photo();
    redirect("photos.php");

} else {
    redirect("photos.php");
}

}
?>