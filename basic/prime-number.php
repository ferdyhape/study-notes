<?php
function isPrime($num)
{
    if ($num <= 1) return false; // 0 and 1 are not prime numbers
    for ($i = 2; $i <= sqrt($num); $i++) { // Loop through 2 to square root of $num
        if ($num % $i == 0) { // If $num is divisible by $i
            return false; // $num is not a prime number
        }
    }
    return true; // $num is a prime number
}

echo isPrime(7) ? "true" : "false"; // Output: true
