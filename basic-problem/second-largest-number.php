<?php
function findSecondLargest($arr)
{
    rsort($arr); // sort array by descending
    return $arr[1]; // return second element
}

echo findSecondLargest([10, 20, 5, 8]); // Output: 10
