<?php
function findUnique($arr)
{
    $counts = array_count_values($arr); // Count the values of an array | Output: Array ( [1] => 1 [2] => 2 [3] => 2 )
    foreach ($counts as $key => $value) { // Loop through the array
        if ($value == 1) {
            return $key; // Kembalikan elemen array tersebut
        }
    }
}

echo findUnique([1, 2, 2, 3, 3]); // Output: 1
