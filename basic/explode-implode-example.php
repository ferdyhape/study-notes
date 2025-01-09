<?php


// explode() function
$string = "Hello World";
$explode = explode(" ", $string);

print_r($explode); // Output: Array ( [0] => Hello [1] => World )

// implode() function
$array = ["Hello", "World"];
$implode = implode(" ", $array);

echo $implode; // Output: Hello World
