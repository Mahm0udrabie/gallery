<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gallery</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="shortcut icon" href="https://cdn3.iconfinder.com/data/icons/complete-set-icons/512/photo512x512.png">

    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        
    <![endif]-->
    <link href="css/styles.css" rel="stylesheet">
  
</head>

<body>
<?php include("includes/navigation.php"); ?>


<style>
    .row{
        height:600px;
        width:auto;
        max-height:1000px;
        background-image:url("http://fibodesign.ir/wp-content/uploads/2015/11/Paralax-Home-Background-4-1.jpg") !important;
        background-repeat: no-repeat;
        background-size:cover;
        }
        body{
            overflow-x:hidden;

        }

    </style>

    <!-- Navigation -->

        <div class="row">
           
        
      
            <!-- Blog Entries Column -->
           <div class="col-md-8">
               <br><br>
        <div class="text-center media-query" >
        <form action="" method="post">
            <label id="title" style="color:white;font-size:45px;">Gallery System</label>
            <p style="color:white;font-size:20px;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi quam repudiandae laboriosam earum deleniti vitae, soluta inventore incidunt fuga minus aliquam possimus eos tempore repellendus, reiciendis expedita officia rerum id!</p>
        <div class="input-group">
        <input type="text" name="search" class="form-control search" placeholder="Search">
        <span class="input-group-btn">
        <button type="submit" class="search-btn btn btn-primary">
            <i style="font-size:25px;" class="glyphicon glyphicon-search"></i>
        </button>
        </span>
    </div>
        </form>       
        </div>
           <div class="text-center">
           <button type="submit" class="join-us" >JOIN US</button>
            </div>
           
            </div>
           


    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4 " id="hideme" style="display:none">
        


            <?php include("includes/sidebar.php"); ?>
</div>


    </div>

 <!--/.row -->
 <?php include("footer_test.php"); ?>
<?php include("includes/footer.php");  ?>
<script>
            $(document).ready(function(){
                $(".col-md-4").hide();
                    $(".join-us").click(function(){
                    $(".col-md-4").show();
                    $(".login").hide();
                    $(".reset").hide();
                    $(".register").show();
                    $(".contact-us").hide();
                    });
            $(".cancel").click(function(){
                $(".col-md-4").hide();
            });
          
            });
</script>
