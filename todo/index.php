<?php
include "bootstrap/init.php";

if (isset($_GET['logout'])){
    
    logout();
}

if (!isLoggedIn()){
    //redirect
    header("Location: ".site_url('auth.php'));
}







$user=getLoggedInUser();
use Hekmatinasser\Verta\Verta;




// var_dump($v = new Verta());
if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])) {
    $d = deleteFolder($_GET['delete_folder']);
    // echo $d;
}

if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])) {
    $d = deleteTasks($_GET['delete_task']);
    // echo $d;
}

if (isset($_GET['foler_id']) && is_numeric($_GET['foler_id'])) {
    $tasks = getTasks($_GET['foler_id']);
    // echo $d;
}else{
    $_GET['foler_id']=0;
    $tasks = getTasks();
}

$folders = getFolders();
//  dd($tasks);
include "tpl/tpl-index.php";
