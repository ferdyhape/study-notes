<?php
function countCharacter($str)
{
    return array_count_values(str_split($str));
}

print_r(countCharacter("hello"));
// Output: Array ( [h] => 1 [e] => 1 [l] => 2 [o] => 1 )
