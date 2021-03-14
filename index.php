<?php
include_once __DIR__ . "/utils.php";
require_once __DIR__ . '/vendor/autoload.php';

if (strtolower($_SERVER['REQUEST_METHOD'])=='post') {
    include_once __DIR__ . "/get.php";
    include_once __DIR__ . "/execute.php";
} else {
    include_once __DIR__ . "/get.php";
}
