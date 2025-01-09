<?php

function getLastDigitString($string)
{
    return $string[strlen($string) - 1];
}


echo getLastDigitString("Hello World"); // Output: d
