<?php
function isPalindrome($word)
{
    $reversedWord = strrev($word); // Reverse the word
    return $word === $reversedWord; // Compare the word with the reversed word
}

echo isPalindrome("katak") ? "true" : "false"; // Output: true
