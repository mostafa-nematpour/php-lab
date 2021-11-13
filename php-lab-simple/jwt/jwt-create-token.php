<?php
include "vendor/autoload.php";

use Firebase\JWT\JWT;

$key = 'mostafaam';
$alg = 'HS256';
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000,
    "user-id" => 8
);
# create and sign jwt token
$jwt = JWT::encode($payload, $key, $alg) ;
print ($jwt) . PHP_EOL . PHP_EOL;

# decode and verify jwt token
try {
    $decoded = JWT::decode($jwt, $key, array($alg));
    print_r($decoded);
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
}
