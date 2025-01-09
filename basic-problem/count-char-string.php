<?php


// function countChar($string, $char)
// {
//     $count = 0;
//     for ($i = 0; $i < strlen($string); $i++) {
//         if ($string[$i] === $char) {
//             $count++;
//         }
//     }
//     return $count;
// }


function countChar($string)
{
    return strlen($string);
}

echo countChar("Hello World"); // Output: 11
