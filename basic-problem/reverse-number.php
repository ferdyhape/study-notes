<?php
function reverseNumber($num)
{
    $reversed = 0;
    while ($num > 0) {
        $lastDigit = $num % 10; // get the last digit of the number
        $reversed = ($reversed * 10) + $lastDigit; // find the reverse of the number
        $num = intdiv($num, 10); // remove the last digit from the number
    }
    return $reversed;
}

echo reverseNumber(123); // Output: 321
