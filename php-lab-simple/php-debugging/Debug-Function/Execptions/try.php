<?php


function sum1($a, $b)
{
    return $a + $b;
}


try {

echo sum1(3);

} catch (Throwable $e) {
var_dump($e);
} finally{

}