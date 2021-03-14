<?php

// Dump & Die for dev purposes only
function dd(...$vars)
{
    foreach ($vars as $var) {
        print_r(json_encode($var));
        pr("\n");
    }
    die;
}

// Print for terminal AND Web
function pr($str)
{
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST') {
        echo nl2br($str);
        return;
    }
    echo ($str);
}