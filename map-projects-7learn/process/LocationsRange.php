<?php
// defined('BASEPATH') OR die('No direct script access allowed');
include '../bootstrap/init.php';

if (!isAjaxRequest()) {
    die("invalid request");
}

// request is AjaxRequest;

if (
    !isset($_GET['northLine']) or
    !isset($_GET['westLine']) or
    !isset($_GET['southLine']) or
    !isset($_GET['eastLine']) or
    empty($_GET['northLine']) or
    empty($_GET['northLine']) or
    empty($_GET['northLine']) or
    empty($_GET['northLine'])
) {
    die("invalid request");
}
$params = [
    'northLine' => $_GET['northLine'],
    'westLine' => $_GET['westLine'],
    'southLine' => $_GET['southLine'],
    'eastLine' => $_GET['eastLine']

];

echo json_encode(getRangeLocations($params));
// ["northLine"]=>
// ["westLine"]=>
// ["southLine"]=>
// ["eastLine"]=>

// var_dump($_GET);
