<?php 
function classAutoloader($class){
 $class = strtolower( $class);
$the_path ="includes/{$class}.php";

if(file_exists($the_path) && class_alias($class)) {
    require_once($the_path);
} else {
    die("this file named {$class} was not found man ...");
}
}
spl_autoload_register('classAutoloader');

function redirect($location){
    header("Location: {$location}");
}
?>