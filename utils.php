<?php

// Dump & Die for dev purposes only
function dd(...$vars): void
{
    foreach ($vars as $var) {
        print_r(json_encode($var));
        pr("\n");
    }
    die;
}

// Print for Terminal AND Web
function pr($str): void
{
    if (isPost()) {
        echo nl2br($str);
        return;
    }
    echo ($str);
}

// Check REQUEST METHOD (and if it really was a request)
function isPost(): bool
{
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST') {
        return true;
    }
    return false;
}