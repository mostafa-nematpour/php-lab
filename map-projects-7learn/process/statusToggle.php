<?php

// defined('BASEPATH') OR die('No direct script access allowed');
include '../bootstrap/init.php';
if (!isAjaxRequest()) {
    die("invalid request");
}

// request is AjaxRequest;


if (is_null($_POST['loc']) or !is_numeric($_POST['loc'])) {
    echo "invalid location";
}
$location_id = $_POST['loc'] ?? null;
echo toggleStatus($_POST['loc']);
