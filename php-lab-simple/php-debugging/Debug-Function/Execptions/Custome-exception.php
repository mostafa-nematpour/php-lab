<?php

/* ----------------------------------------------------------------
set_exception_handler("my_excaption_handler");
function my_excaption_handler($excdeption)
{
    echo "my_excaption_handler";
}

throw new DivisionByZeroException("division by zero occurred!");


try {
    //code...
} catch (\Throwable $th) {
    //throw $th;
}

// set_error_handler("my_error_handler");
// function my_error_handler (...)
// {
//     echo "my_error_handler";
// }










class DivisionByZeroException extends Exception
{
}


include "Logger.php";

$logger = new Logger();

$r = rand(0, 0); // number of people
$apples = 10;
echo "r= $r, apples= $apples\n";


try {
    if ($r == 0) {
        throw new DivisionByZeroException("division by zero occurred!");
    }
    echo "apple/people: " . $apples / $r;
} catch (\Throwable $th) {

    $logger->log($th);
    echo "no Person!";
}
