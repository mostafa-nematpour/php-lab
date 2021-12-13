<?php
# cache constans
define('CACHE_ENABLED',0);
define('CACHE_DIR',__DIR__.'/cache/');

# authorization  Constants
define('JWT_ALG','HS256');
define('JWT_KEY','mostafachemidona8*8');




include_once 'vendor/autoload.php';
include_once 'App/iran.php';

spl_autoload_register(function ($class) {
    $class_file = __DIR__ . '\\' . $class . '.php';
    if (!(file_exists($class_file) and is_readable($class_file))) {
        die("$class_file not found");
    }
    include_once $class_file;
});


// use \App\Services\CityService;
// use \App\Utilities\Response;

// new CitySersfvice();

// Response::respond([9, 4, 56, 4], 300);
