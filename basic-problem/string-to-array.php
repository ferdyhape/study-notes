<?php

$string = "Hello World";

// split string by character
function stringToArray($string)
{
    $array = [];
    for ($i = 0; $i < strlen($string); $i++) {
        $array[] = $string[$i];
    }
    return $array;
}

print_r(stringToArray($string)); // Output: Array ( [0] => H [1] => e [2] => l [3] => l [4] => o [5] =>   [6] => W [7] => o [8] => r [9] => l [10] => d )
