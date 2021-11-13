<?php

function linePrint($title)
{
    echo "\n<h3>**** $title ****</h3>\n";
}

$site = 'localhost';
$number = 8;
$obj = (object)['age' => 77, 'color' => 'blue'];
$obj1 = new stdClass;
$obj2 = $obj;

linePrint("var_dump:");
var_dump($site);

linePrint('print_r(obj):');
print_r($obj);

linePrint('print_r(obj):');
print_r($site);

$allVariables =get_defined_vars();
linePrint('get_defined_vars');
print_r($allVariables);

linePrint('debug_zval_dump');
debug_zval_dump($allVariables);

function myPrint($str)
{
    echo $str;
    debug_print_backtrace();
}

function proxy($str)
{
    myPrint($str);
}

linePrint('debug_print_backtrace: ');
proxy("$site | $number");

/*


*/