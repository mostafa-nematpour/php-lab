<?php
include "bootstrap/init.php";
$alert = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET['action'];
    $params = $_POST;
    if ($action == 'register') {
        $result = register($params);
        if (!$result) {
            //  echo "ERROR";
            $alert = 2;
        } else {
            $alert = 1;
            //  echo "ok";
        }
    } elseif ($action == 'login') {
        $result = login($params['email'], $params['password']);
        if (!$result) {
            echo "user Email or Password is Incorrest!";
        } else {
            var_dump("you are login");
            header("Location: " . site_url());
        }
    }
    //var_dump($result);
}

include "tpl/tpl-auth.php";
