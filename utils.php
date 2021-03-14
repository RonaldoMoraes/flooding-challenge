<?php
function dd(...$vars)
{
    foreach ($vars as $var) {
        print_r(json_encode($var));
        pr("\n");
    }
    die;
}

function pr($str)
{
    echo ($str);
    // echo nl2br($str);
}