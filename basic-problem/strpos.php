<?php


function getIndexOfString($string, $char)
{
    return strpos($string, $char);
};

echo getIndexOfString("Hello World", "W"); // Output: 6
