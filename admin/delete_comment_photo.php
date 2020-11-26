<?php include("includes/init.php");?>
<?php
$check_user = User::find_by_id($_SESSION['user_id']);
if($check_user->status != "Admin") { 
    redirect("../index.php");
} else if ($check_user->status == "Admin") {
if(!$session->is_signed_in()){ redirect("login.php"); } ?>

<?php 
if(empty($_GET['id'])){
        redirect("comments.php");
}
$comment = Comment::find_by_id($_GET['id']);
if($comment){
    $session->message("The comment with {$comment->id} has been deleted");

    $comment->delete();
    redirect("photo_comment.php?id={$comment->photo_id }");

} else {
    redirect("photo_comment.php?id={$comment->photo_id }");
}

}
?>