<?php
function generateFibonacci($length)
{
    $fib = [0, 1];
    for ($i = 2; $i < $length; $i++) {
        $fib[] = $fib[$i - 1] + $fib[$i - 2];
    }
    return $fib;
}

print_r(generateFibonacci(5)); // Output: [0, 1, 1, 2, 3]
