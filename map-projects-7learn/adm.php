<?php
include "bootstrap/init.php";


if (isset($_GET['logout']) and $_GET['logout'] == 1) {
    logout();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!login($_POST['username'], $_POST['password'])) {
        echo "نام کاربری یا رمز ورود اشتباه است";
    }
}

if (isLoggedin()) {
    $params = $_GET ?? [];
    $locations = getLocations($params);
    // dd($locations);
    include "tpl/tpl-adm.php";
} else {
    include "tpl/tpl-adm-form.php";
}
