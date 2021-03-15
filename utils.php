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

function printHeaderSubtitle(): void
{
    if (!isPost()) {
        pr("Legenda: \nAr: ' ' (Espaço em branco)\nÁgua: ~\nTerreno: X\n\n");
        return;
    }
    pr("Legenda: \n Ar: <div style='width:10px;height:10px;background-color:pink;border: 1px solid black;'></div>\nÁgua: " . 
        "<div style='width:10px;height:10px;background-color:blue;border: 1px solid black;'></div>\nTerreno: <div style='width:10px;height:10px;background-color:black;border: 1px solid black;'></div>\n\n"
    );
}