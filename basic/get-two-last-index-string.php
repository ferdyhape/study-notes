<?php
function getTwoLastIndexString($str)
{
    $len = strlen($str);
    return substr($str, $len - 2, 2);
};


echo getTwoLastIndexString("Hello World"); // Output: ld
