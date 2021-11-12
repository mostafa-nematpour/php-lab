<?php
namespace App\Utilities;
class Response
{
    public static function respond($data, $status_code)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("http 1/1 $status_code OK");
        return json_encode($data);
    }
}
