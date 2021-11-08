<?php

// defined('BASEPATH') OR die('No direct script access allowed');
include '../bootstrap/init.php';
if (!isAjaxRequest()) {
    die("invalid request");

}

// request is AjaxRequest;

if(insertLocation($_POST)){
    echo 'مکان با موفقیت در پایگاه داده ثبت شده و منتظر تایید هست.';
}else{
    echo 'مشکلی در ثبت پیش آمده.';
}