<?php
function reverseArrayChar($string)
{
    $array = str_split($string); // Split string into array
    return array_reverse($array); // Reverse the array
};

print_r(reverseArrayChar("12345")); // Output: Array ( [0] => 5 [1] => 4 [2] => 3 [3] => 2 [4] => 1 )
