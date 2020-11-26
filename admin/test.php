<?php include "includes/init.php" ?>
<?php
$check_user = User::find_by_id($_SESSION['user_id']);
if($check_user->status != "Admin") { 
    redirect("../index.php");
} else if ($check_user->status == "Admin") {
if(!$session->is_signed_in()){ redirect("login.php"); } ?>
        <form action=" " method="post">
        <button type="submit" name="Add" class="btn btn-primary">Add New</button> 
        </form>

        <?php  if(isset($_POST['Add'])) { ?>
        <hr>
         Add user :
        <form  action=" " method="post">
        <div class="form-group">

        <input type="text"  class="form-control" name="username" placeholder="username">
        </div>
        <div class="form-group">

        <input type="password" class="form-control" name="password" placeholder="password">
        </div>
        <div class="form-group">

        <input type="text" class="form-control" name="firstname" placeholder="firstname">
        </div>
        <div class="form-group">

        <input type="text" class="form-control" name="lastname" placeholder="lastname">
        </div>
        <div class="form-group">
        
        <button type="submit" name="submit" class="btn btn-success"> Add user</button>   
        </div>    

        </form>         

        
          <?php } ?>
    
        <hr>
   
           Edit / Delete :
           <form action=" " method="post">
           <div class="form-group" >
            <select name="usersname"  class="form-control" required>
            <option value="" selected="selected"  disabled>users</option>
            <?php 
            $users = User::find_all();
                foreach ($users as $user) { 
            ?>
            <option value="<?php echo $user->id?>"><?php echo $user->username ?></option>
            <?php
                    }
            
            ?>
              </select>     
              </div>
        <div class="form-group">
        <button type="submit" name="select" class="btn btn-warning">Edit user</button> 
        <button type="submit" name="delete" class="btn btn-danger">delete</button> 
        </div>
        </form>
        
         
            <?php 
              if(isset($_POST['select'])){
          
           
                $user = User::find_by_id($_POST['usersname']);   
                ?>
    
                <form  action=" " method="post">
                <div class="form-group">
                <input type="text" name="userupdate"  class="form-control" placeholder="username" value="<?php if(isset($user->username)) { echo $user->username; }  ?>">
                </div>
                <div class="form-group">
                <input type="password" name="passupdate"  class="form-control" placeholder="password" value="<?php if(isset($user->username)) { echo $user->password; }  ?>">
                </div>
                <div class="form-group">    
                <input type="text" name="firstupdate"  class="form-control" placeholder="firstname" value="<?php if(isset($user->username)) { echo $user->first_name; }  ?>">
                </div>
                <div class="form-group">
                <input type="text" name="lastupdate"  class="form-control" placeholder="lastname" value="<?php if(isset($user->username)) { echo $user->last_name; }  ?>">
                </div>
                <div class="form-group">
                <button type="submit" name="edituser" class="btn btn-primary">update</button>
                </div>
                </form>
                <?php 
                 }
            if(isset($_POST['submit'])){
                    $user = new User();
                    $user->username   = $_POST['username'];
                    $user->password   = $_POST['password'];
                    $user->first_name = $_POST['firstname'];
                    $user->last_name  = $_POST['lastname'];
                    $user->save();
            } 
             if(isset($_POST['edituser'])){
                // $user_edit = User::find_user_by_id($_POST['usersname']);   
                $user->username   =  $_POST['userupdate'];
                $user->password   =  $_POST['passupdate'];
                $user->first_name =  $_POST['firstupdate'];
                $user->last_name  =  $_POST['lastupdate'];
                $user->save();
            }
            if(isset($_POST['delete'])){
                $Duser = new User();
                $Duser->id   = $_POST['usersname'];
                $Duser = User::find_by_id($Duser->id);   
                $Duser->delete();
    
            }
        }
            ?> 