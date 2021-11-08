<?php
// defined('BASEPATH') OR die('No direct script access allowed');
include '../bootstrap/init.php';
// usleep(500000);
if (!isAjaxRequest()) {
    die("invalid request");
}

// request is AjaxRequest;

if (!isset($_POST['keyword']) or empty($_POST['keyword'])) {
    die("شروع به تایپ کنید.");
}
$keyword = $_POST['keyword'];
$locations = getLocations(['keyword' => $keyword]);
if (sizeof($locations)==0) {
    die('نتیجه ای یافت نشد.');
}
foreach ($locations as $loc) {
    echo "<a href='".BASE_URL."?loc=$loc->id'> <div class='result-item' data-lat='$loc->lat' data-lng='$loc->lng' data-loc='$loc->id'>
    <span class='loc-type'>".locationTypes[$loc->type]."</span>
    <span class='loc-title'>$loc->title</span></div></a>";
}
// dd($locations);


#better solution 
#send header content type
#echo json_encode($locations);