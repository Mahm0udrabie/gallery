<?php 
ob_start();
include("includes/header.php"); ?>
<?php 
if($session->is_signed_in()){
$page =!empty($_GET['page']) ? (int)$_GET['page'] : 1 ;
$items_per_page = 8;
$items_total_count = Photo::count_all();
$paginate = new Paginate($page,$items_per_page,$items_total_count);
$sql  = "SELECT * FROM photos  order by id desc
LIMIT {$items_per_page} OFFSET {$paginate->offset()} ";
$photos = Photo::find_by_query($sql);


//$photos= Photo::find_all(); 

?>
<style>
body {
    overflow-x:hidden;
}
</style>

<div class="row">
            <!-- Blog Entries Column -->
    <div class="col-md-8">

        <div class="thumbnails">

            <?php 

            foreach ($photos as $photo) : ?>
            <?php 
            $list_1 = "<div class='col-md-12'>";
            $list_4 = "<div class='col-xs-6 col-md-3'>";
            $design = User::find_by_id($_SESSION['user_id']);
            if($design->list_type == "list_1") {
            echo $list_1;
            }
            else if($design->list_type == "list_4")  {
            echo $list_4;
            }  else {
                echo $list_1;
            }
            ?>
            <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                <img class="home_page_photo img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
            </a> 
            </div><!-- end div list 1 or 4 -->
            <?php endforeach; ?>
        </div><!-- thumbnail  div-->
        <div class="row">
            <ul class="pagination">
<?php  if($paginate->page_total() > 1) {
    if($paginate->has_next()) {
            echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
        
    }
    for ($i=1; $i <=$paginate->page_total() ; $i++) { 
        if($i == $paginate->current_page) {
            echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
        } else {
            echo "<li ><a href='index.php?page={$i}'>{$i}</a></li>";

        }
    }
    
    if($paginate->has_previous()) {
            echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
        
    }
}
?>
                <li>
                    <form action="" method="post" style="display:inline-block">
                    <div class="input-group">
                        <button name="list_4" class="btn btn-default" type="submit" style="background-color:transparent;:none;border:0px solid white;height:33.5px;width:45px;">
                            <i class="glyphicon glyphicon-th-large" style="color:black"></i>
                        </button>
                    </div>
                    </form>    
                </li>
                <li>  
                    <form action="" method="post" style="display:inline-block">
                    <div class="input-group">
                        <button name="list_1" class="btn btn-default" type="submit" style="background-color:transparent;:none;border:0px solid white;height:33.5px;width:45px;">
                            <i class="glyphicon glyphicon-stop" style="color:black"></i>
                        </button>
                    </div>
                    </form>
                </li>
            </ul>

            </div>
</div>



    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">


            <?php include("includes/sidebar.php"); }?>
            
    </div>
 <!--/.row -->
 

<?php include("includes/footer.php");?>

