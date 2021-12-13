<?php
include "../../../loader.php";

use \App\Services\CityService;
use \App\Utilities\Response;
use \App\Utilities\CacheUtility;


# check Authorization (use ajwt token)
# get request token and validate it

$request_method = $_SERVER['REQUEST_METHOD'];
$request_body = json_decode(file_get_contents('php://input'), true);
$city_service = new CityService();

// Response::respondAndDie($request_body);
switch ($request_method) {

    case 'GET':
   
        CacheUtility::start();

        $province_id = $_GET['province_id'] ?? null;


        # do validate : province_id
        $request_data = [
            'province_id' => $province_id,
            'fields' => $_GET['fields'] ?? null,
            'page' => $_GET['page'] ?? null,
            'pagesize' => $_GET['pagesize'] ?? null,
        ];

        $response = $city_service->getCities($request_data);

        if (empty($response))
            Response::respondAndDie($response, Response::HTTP_NOT_FOUND);

        echo Response::respond($response, Response::HTTP_OK);

        CacheUtility::end();
        break;

    case 'POST':

        if (!isValidCity($request_body))
            Response::respondAndDie(["invalid City data"], Response::HTTP_NOT_ACCEPTABLE);
        $response = $city_service->createCity($request_body);
        Response::respondAndDie($response, Response::HTTP_CREATED);

        break;

    case 'PUT':

        [$city_id, $city_name] = [$request_body['city_id'], $request_body['name']];
        if (!is_numeric($city_id) or empty($city_name)) {
            Response::respondAndDie(["invalid City data"], Response::HTTP_NOT_ACCEPTABLE);
        }
        $response = $city_service->updateCityName($city_id, $city_name);
        // if ($) {
        //     # code...
        // }
        Response::respondAndDie($response, Response::HTTP_OK);
        break;

    case 'DELETE':

        $city_id = $_GET['city_id'];
        if (!is_numeric($city_id) or is_null($city_id)) {
            Response::respondAndDie(["invalid City data"], Response::HTTP_NOT_ACCEPTABLE);
        }
        $response = $city_service->deleteCity($city_id);

        Response::respondAndDie($response, Response::HTTP_OK);
        break;

    default:
        Response::respondAndDie(['Invalid request method'], Response::HTTP_METHOD_NOT_ALLOWED);
}
