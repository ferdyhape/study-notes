<?php
function reverseWords($sentence)
{
    $words = explode(" ", $sentence); // Split sentence into words array
    $reversed = array_reverse($words); // Reverse the words array
    return implode(" ", $reversed); // Join the words array into sentence
}

echo reverseWords("Saya suka coding"); // Output: "coding suka Saya"
