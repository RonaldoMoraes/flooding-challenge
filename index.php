<?php
include_once(__DIR__ . "/utils.php");
require_once __DIR__ . '/vendor/autoload.php';

if (strtolower($_SERVER['REQUEST_METHOD'])=='post') {
    echo "POST<br>";
    // include_once(__DIR__ . "/get.php");
    include_once(__DIR__ . "/post.php");
} else {
    echo "GET<br>";
    include_once(__DIR__ . "/get.php");
}
