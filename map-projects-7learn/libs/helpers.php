<?php defined('BASE_PATH') OR die("Permision Denied!");

function getCurrentUrl()
{
    return 1;
}


function isAjaxRequest()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }
    return false;
}


function diePage($msg, $titel = "Error")
{
    include_once BASE_PATH . "tpl/tpl-die.php";
    die();
}


function dd($var){
    echo "<pre style='color: #9c4100; direction:ltr; text-align: left; background: #fff; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #c56705;'>";
    var_dump($var);
    echo "</pre>";
}



function site_url ($uri = ''){
    return BASE_URL.$uri;
}

