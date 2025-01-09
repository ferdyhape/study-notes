<?php
function sortArray($arr)
{
    $n = count($arr);
    for ($i = 0; $i < $n; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            if ($arr[$i] > $arr[$j]) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
            }
        }
    }
    return $arr;
}

print_r(sortArray([5, 3, 8, 1])); // Output: [1, 3, 5, 8]
