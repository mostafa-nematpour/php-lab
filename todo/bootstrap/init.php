<?php
session_start();
include "constans.php";
include BASE_PATH . "bootstrap/config.php";
include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "libs/helpers.php";


try {
    $PDO = new PDO(
        "mysql:dbname=$database_config->db;host={$database_config->host}",
        $database_config->user,
        $database_config->pass
    );
} catch (PDOException $e) {
    diePage($e->getMessage(), "Database Connection Faile");
}
// echo "Not failed";


include BASE_PATH . "libs/lib-auth.php";
include BASE_PATH . "libs/lib-tasks.php";
