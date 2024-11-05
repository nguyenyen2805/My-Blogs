<?php
include 'blog/layout/header.php';
include 'system/connec_db.php';
include 'system/unterity.php';
?>




<?php 
error_reporting(0);
$page= $_GET['page'];
$action=$_GET['action'];

if(!isset($page) || empty($page) ){
    
    @$file='blog/module/page/home.php';
    
}else{
    @$file="blog/module/$page/$action.php";
}


if(file_exists($file)){
    @include $file;
}else{
    @include './blog/page/home.php';
}

?>



<?php
include 'blog/layout/footer.php';
?>