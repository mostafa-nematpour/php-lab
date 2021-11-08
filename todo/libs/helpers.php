<?php

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

function dd($var)
{
    echo "<pre style='color:red'>";
    var_dump($var);
    echo "</pre> <hr>";

}

function site_url ($uri = ''){
    return BASE_URL.$uri;
}