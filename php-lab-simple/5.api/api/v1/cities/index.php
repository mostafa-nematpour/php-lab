<?php
include "../../../loader.php";

use \App\Services\CityService;
use \App\Utilities\Response;

$cs = new CityService();
$result = $cs->getCities((object)[1, 1, 2, 1]);

Response::respondAndDie($result, Response::HTTP_OK);
